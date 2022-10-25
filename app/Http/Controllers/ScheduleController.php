<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Route;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedule = Schedule::whereDate('leave', now())->paginate(10);
        return response()->json($schedule);
    }

    public function store(StoreScheduleRequest $request)
    {
        try {
            DB::beginTransaction();
            $route = Route::find($request->route_id);
            $leave = (new Carbon($request->leave))->toImmutable()->setTimezone('Asia/Jakarta');
            $arrive = $leave->addMinutes($route->time_taken);

            $schedule = Schedule::create([
                'bus_id' => $request->bus_id,
                'driver_id' => $request->driver_id,
                'route_id' => $request->route_id,
                'leave' => $leave,
                'arrive' => $arrive,
                'status' => $request->status
            ]);

            DB::commit();
            return response()->json([
                'message' => "new schedule created successfully!",
                'data' => $schedule
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
        }
    }

    public function show(Schedule $schedule)
    {
        return response()->json($schedule);
    }

    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        try {
            DB::beginTransaction();

            if ($request->route_id) {
                $schedule->route_id = $request->route_id;
                $route = Route::find($request->route_id);
            } else {
                $route = Route::find($schedule->route_id);
            }

            if ($request->leave) {
                $leave = (new Carbon($request->leave))->toImmutable()->setTimezone('Asia/Jakarta');
                $arrive = $leave->addMinutes($route->time_taken);
                $schedule->leave = $leave;
                $schedule->arrive = $arrive;
            }

            if ($request->bus_id) $schedule->bus_id = $request->bus_id;
            if ($request->driver_id) $schedule->driver_id = $request->driver_id;
            if ($request->status) $schedule->status = $request->status;

            $schedule->update();
            DB::commit();
            return response()->json([
                'message' => "schedule updated successfully!",
                'data' => $schedule
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
        }
    }

    public function destroy(Schedule $schedule)
    {
        try {
            DB::beginTransaction();
            $schedule->delete();
            DB::commit();
            return response()->json(['message' => "schedule deleted successfully!"]);
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
        }
    }
}
