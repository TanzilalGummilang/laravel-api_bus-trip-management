<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRouteRequest;
use App\Http\Requests\UpdateRouteRequest;
use App\Models\Route;
use App\Models\Terminal;
use Illuminate\Support\Facades\DB;

class RouteController extends Controller
{
    public function index()
    {
        $route = Route::select(['id', 'code', 'origin', 'destination', 'time_taken'])->paginate(10);
        return response()->json($route);
    }

    public function store(StoreRouteRequest $request)
    {
        try {
            DB::beginTransaction();
            $route = Route::create([
                'code' => $request->code,
                'origin' => $request->origin,
                'destination' => $request->destination,
                'time_taken' => $request->time_taken,
                'bus_stop' => json_encode($request->bus_stop)
            ]);

            self::jsonBusStop($route);
            DB::commit();
            return response()->json([
                'message' => "new route created successfully!",
                'data' => $route
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
        }
    }

    public function show(Route $route)
    {
        self::jsonBusStop($route);
        return response()->json([
            'data' => $route
        ]);
    }

    public function update(UpdateRouteRequest $request, Route $route)
    {
        try {
            DB::beginTransaction();
            $method = $request->method();
            if ($method == 'PATCH') {
                if($request->bus_stop) $route->update(['bus_stop' => json_encode($request->bus_stop)]);
                if($request->code) $route->update(['code' => $request->code]);
                if($request->origin) $route->update(['origin' => $request->origin]);
                if($request->destination) $route->update(['destination' => $request->destination]);
                if($request->time_taken) $route->update(['time_taken' => $request->time_taken]);
            } else {
                $route->update([
                    'code' => $request->code,
                    'origin' => $request->origin,
                    'destination' => $request->destination,
                    'time_taken' => $request->time_taken,
                    'bus_stop' => json_encode($request->bus_stop)
                ]);
            }

            self::jsonBusStop($route);
            DB::commit();
            return response()->json([
                'message' => "route updated successfully!",
                'data' => $route
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
        }
    }

    public function destroy(Route $route)
    {
        try {
            DB::beginTransaction();
            $route->delete();
            DB::commit();
            return response()->json(['message' => "route delete successfully!"]);
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
        }
    }

    protected function jsonBusStop($route)
    {
        $route->bus_stop = json_decode($route->bus_stop, true);
        $terminals = Terminal::whereIn('id', array_column($route->bus_stop, 'id'))
            ->select('id', 'type', 'code', 'name', 'address')
            ->get();
        $route->bus_stop = array_map(function ($value) use ($terminals) {
            $value['terminal'] = $terminals->where('id', $value['id'])->first();
            return $value;
        }, $route->bus_stop);
    }
}
