<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePharmacyRequest;
use App\Models\Pharmacy;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pharmacies=Pharmacy::all();
        return response()->json(['message'=>'Success', 'pharmacies'=>$pharmacies]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePharmacyRequest $request)
    {
        $pharmacy= new Pharmacy;
        $pharmacy->name=$request->name;
        $pharmacy->address=$request->address;
        $pharmacy->save();

      return response()->json(['message'=>'Pharmacy created successfully','pharmacy'=>$pharmacy],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePharmacyRequest $request, string $id)
    {
        $pharmacy=Pharmacy::find($id);
        if(is_Null($pharmacy)){
            return response()->json(['message'=>'Invailed pharmacy Id ']);
        }else{
            $pharmacy->name=$request->name;
            $pharmacy->address=$request->address;
            $pharmacy->save();
            return response()->json(['message'=>'Pharmacy updated successfully','pharmacy'=>$pharmacy],201);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pharmacy=Pharmacy::find($id);
        if(isNull($pharmacy)){
            return response()->json(['message'=>'Invailed pharmacy Id ']);
        }else{
            $pharmacy->delete();
            return response()->json(['message'=>' Pharmacy deleted successfully']);

        }

    }
}
