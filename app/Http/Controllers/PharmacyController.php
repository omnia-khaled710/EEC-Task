<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePharmacyRequest;
use App\Http\Requests\UpdatePharmacyRequest;
use App\Models\Pharmacy;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $pharmacies= Pharmacy::all();
        return view('pharmacies.list',compact('pharmacies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pharmacies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePharmacyRequest $request)
    {
        $pharmacy=new Pharmacy();
        $pharmacy->name= $request->name;
        $pharmacy->address= $request->address;
        $pharmacy->save();
        return redirect()->route('pharmacies.index')->with('success','pharmacy created successfully');
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
        $pharmacy=Pharmacy::find($id);
        return view('pharmacies.edit',compact('pharmacy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePharmacyRequest $request, string $id)
    {
        $pharmacy=Pharmacy::findOrFail($id);
        $pharmacy->name=$request->name;
        $pharmacy->address=$request->address;
        $pharmacy->save();
        return redirect()->route('pharmacies.index')->with('success','pharmacy Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        $pharmacy->delete();
    return redirect()->back()->with('success', 'Pharmacy deleted successfully');
    }
}
