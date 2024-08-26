<?php

namespace App\Http\Controllers;

use App\Models\SalatTime;
use Illuminate\Http\Request;

class SalatTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salatTimes = SalatTime::all();
        return view('salat.index', compact('salatTimes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('salat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'salat_name' => 'required|string|max:255',
            'ajan_time' => 'required|date_format:H:i',
            'namaz_time' => 'required|date_format:H:i',
        ]);

        
        SalatTime::create([
            'salat_name' => $request->input('salat_name'),
            'ajan_time' => $request->input('ajan_time'),
            'namaz_time' => $request->input('namaz_time'),
        ]);

        // Redirect back to the form with a success message
        return redirect()->route('salat-time.create')->with('success', 'Salat time created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SalatTime $salatTime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $salatTime = SalatTime::findOrFail($id);
        $salatTime->ajan_time = \Carbon\Carbon::parse($salatTime->ajan_time);
        $salatTime->namaz_time = \Carbon\Carbon::parse($salatTime->namaz_time);

        return view('salat.edit', compact('salatTime'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'salat_name' => 'required|string|max:255',
            'ajan_time' => 'required|date_format:H:i',
            'namaz_time' => 'required|date_format:H:i',
        ]);

        // Find the existing SalatTime record by ID
        $salatTime = SalatTime::findOrFail($id);

        // Update the record with validated data
        $salatTime->update([
            'salat_name' => $validatedData['salat_name'],
            'ajan_time' => $validatedData['ajan_time'],
            'namaz_time' => $validatedData['namaz_time'],
        ]);

        // Redirect back with a success message
        return redirect()->route('salat-time.index')->with('success', 'Salat time updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the SalatTime record by ID or fail if not found
        $salatTime = SalatTime::findOrFail($id);

        // Delete the record
        $salatTime->delete();   

        // Redirect back with a success message
        return redirect()->route('salat-time.index')->with('success', 'Salat time deleted successfully.');
    }

}
