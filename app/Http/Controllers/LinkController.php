<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Country;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('link.index', [
            'links' => Link::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('link.create', [
            'countries' => Country::orderBy('name')->get(),
        ]);
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
            'code' => 'required',
            'description' => 'nullable',
            'default_url' => 'required',
            'robot_url' => 'nullable',
            'country_url' => 'nullable',
            'device_url' => 'nullable',
        ]);

        Link::create($validated);

        return redirect()->route('link.index')->with('status', 'Link created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('link.edit', [
            'link' => Link::where('id', $id)->first(),
            'countries' => Country::orderBy('name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'description' => 'nullable',
            'default_url' => 'required',
            'country_url' => 'nullable',
            'device_url' => 'nullable',
            'robot_url' => 'nullable',
        ]);

        $link = Link::find($id);

        $link->update($validated);

        return redirect()->route('link.index')->with(['status' => 'Link updated successfully']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $link = Link::find($id);

        $link->delete();

        return redirect()->route('link.index')->with(['status' => 'Link deleted successfully.']);
    }
}
