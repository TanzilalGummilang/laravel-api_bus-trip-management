<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Models\Driver;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::paginate(10);
        return response()->json($drivers);
    }

    public function store(StoreDriverRequest $request)
    {
        $driver = Driver::create($request->validated());
        return response()->json([
            'message' => "New driver created successfully!",
            'data' => $driver
        ]);
    }

    public function show(Driver $driver)
    {
        return response()->json($driver);
    }

    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        $driver->update($request->validated());
        return response()->json([
            'message' => "Driver updated successfully!",
            'data' => $driver
        ]);
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return response()->json(['message' => "Driver deleted successfully!"]);
    }
}
