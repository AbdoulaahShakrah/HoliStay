<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StorePropertyTaxRequest;
use App\Http\Resources\v1\PropertyTaxResource;
use App\Models\PropertyTax;
use Illuminate\Http\Request;

class PropertyTaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyTaxRequest $request)
    {
        
        $propertyTax = PropertyTax::create($request->all());
        return new PropertyTaxResource($propertyTax);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
