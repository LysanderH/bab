<?php

namespace App\Http\Controllers;

use App\Models\Period;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.period.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'start' => 'date',
            'end' => 'date|after:start',
            'deadline' => 'date|after:start|before:end',
        ]);



        $periods = Period::where('active', true)->get();

        foreach ($periods as $per) {
            Period::find($per->id)->update([
                'active' => false,
            ]);
        }

        Period::create([
            'start' => $validated['start'],
            'end' => $validated['end'],
            'deadline' => $validated['deadline'],
            'active' => true,
        ]);

        $request->session()->flash('success', 'Le livre à bien été ajouté.');

        return redirect(route('admin.dashboard'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function show(Period $period)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function edit(Period $period)
    {
        $period = Period::where('id', $period->id)->first();
        return view('admin.period.edit', ['period' => $period]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Period $period)
    {
        $validated = $request->validate([
            'start' => 'date',
            'end' => 'date|after:start',
            'deadline' => 'date|after:start|before:end',
        ]);

        Period::find($period->id)->update([
            'start' => $validated['start'],
            'end' => $validated['end'],
            'deadline' => $validated['deadline'],
        ]);

        $request->session()->flash('success', 'La période à bien été modifié.');

        return redirect(route('admin.dashboard'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function destroy(Period $period)
    {
        //
    }
}
