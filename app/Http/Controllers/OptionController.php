<?php

namespace App\Http\Controllers;

use App\Models\agoptions;
use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Requests\AgencyOptionRequest;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Agency/Options/OptionsList', [
            'options' => Option::AgencyOp(Session('agid'), '!=')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return Inertia::render('Agency/Options/NewOption', [
            'optionslist' => Option::AgencyOp(Session('agid'))
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AgencyOptionRequest $request)
    {
        $OptionData=[
            'price' => $request->input('price'),
            'nop' => $request->input('nop'),
            'option_id'=> $request->input('option_id'),
            'agency_id'=> $request->session()->get('agid')
          ];
  
          $option = agoptions::create($OptionData);
          return redirect()->back()->with('success', 'Option add successfully !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //dd($id);
        
        $option = agoptions::where('id', $id)->get()->first();
        if ($option->photo && Storage::exists($option->photo)){
                Storage::delete($option->photo);

        }
        $option->delete();
        return redirect()->back();
    }
    
}
