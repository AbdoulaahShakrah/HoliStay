<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PropertyCollection;
use App\Http\Resources\V1\PropertyResource;
use App\Models\Property;
use App\Services\V1\PropertyFilter;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new PropertyFilter();
        $queryItems = $filter->transform($request); //[['column', 'operator', 'value]] propertyStatus[eq]=Occupied
        if(count($queryItems) == 0){
            return new PropertyCollection(Property::with('photos', 'property_taxes', 'property_amenities')->paginate(20));
        }
        else{
            $properties = Property::where($queryItems)->with('photos', 'property_taxes', 'property_amenities')->paginate(20);
            return new PropertyCollection($properties->appends($request->query()));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        return new PropertyResource($property->loadMissing('photos', 'property_taxes', 'property_amenities'));
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
