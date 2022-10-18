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
        $bus = new Bus();
        $bus->number_plate = $request->number_plate;
        $bus->serial_number = $request->serial_number;
        $bus->distributor = $request->distributor;
        $bus->number_of_seats = $request->number_of_seats;
        $bus->save();
        return response()->json($bus);
    }

    public function show(Bus $bus)
    {
        return response()->json($bus);
    }

    public function update(UpdateBusRequest $request, Bus $bus)
    {
        $bus->update($request->validated());
        return response()->json($bus);
    }

    public function destroy(Bus $bus)
    {
        $bus->delete();
        return response()->json();
    }
}
