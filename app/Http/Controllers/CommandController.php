<?php

namespace App\Http\Controllers;

use App\Models\Command;
use Illuminate\Http\Request;

class CommandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commands = Command::with('client')->get();
        return view('commands.index', compact('commands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $command = Command::find($id);
        return view('commands.show', compact('command'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function status(Request $request, string $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:in progress,sent,delivered,return'
        ]);
        $command = Command::find($id);
        $command->status = $validated['status'];
        $command->save();
        return redirect()->route('commands.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $command = Command::find($id);
        if($command){
            $command->delete();
            return response()->json(['success' => true, 'message' => 'Command deleted successfully']);
        }
        return response()->json(['success' => false, 'message' => 'Command not found']);
    }

    public function filterByStatus(Request $request){
        if($request->status != '-1'){
            $commands = Command::where('status', $request->status)->get();
        }else{
            $commands = Command::all();
        }
        return view('commands.index', compact('commands'));
    }
}
