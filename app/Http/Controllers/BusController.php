<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBusRequest;
use App\Http\Requests\UpdateBusRequest;
use App\Models\Bus;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::paginate(10);
        return response()->json($buses);
    }

    public function store(StoreBusRequest $request)
    {
        $buses = Bus::create($request->validated());
        return response()->json([
            'message' => "new bus created successfully!",
            'data' => $buses
        ]);
    }

    public function show(Bus $bus)
    {
        return response()->json($bus);
    }

    public function update(UpdateBusRequest $request, Bus $bus)
    {
        $bus->update($request->validated());
        return response()->json([
            'message' => "bus updated successfully!",
            'data' => $bus
        ]);
    }

    public function destroy(Bus $bus)
    {
        $bus->delete();
        return response()->json(['message' => "bus deleted successfully!"]);
    }
}
