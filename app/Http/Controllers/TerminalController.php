<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTerminalRequest;
use App\Http\Requests\UpdateTerminalRequest;
use App\Models\Terminal;

class TerminalController extends Controller
{
    public function index()
    {
        $terminals = Terminal::paginate(10);
        return response()->json($terminals);
    }

    public function store(StoreTerminalRequest $request)
    {
        $terminals = Terminal::create($request->validated());
        return response()->json([
            'message' => "new $request->type created successfully!",
            'data' => $terminals
        ]);
    }

    public function show(Terminal $terminal)
    {
        return response()->json($terminal);
    }

    public function update(UpdateTerminalRequest $request, Terminal $terminal)
    {
        $terminal->update($request->validated());
        return response()->json([
            'message' => "$terminal->type updated successfully!",
            'data' => $terminal
        ]);
    }

    public function destroy(Terminal $terminal)
    {
        $terminal->delete();
        return response()->json(['message' => "$terminal->type $terminal->name deleted successfully!"]);
    }
}
