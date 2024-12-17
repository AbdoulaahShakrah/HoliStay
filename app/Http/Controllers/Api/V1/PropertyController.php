<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StorePropertyRequest;
use App\Http\Resources\V1\PropertyCollection;
use App\Http\Resources\V1\PropertyResource;
use App\Models\Property;
use App\Models\Reservation;
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
        $queryItems = $filter->transform($request); // Filtros do request

        if (count($queryItems) <= 1) {
            if ($queryItems[0][0] == 'check_in_date' && $queryItems[1][0] == 'check_out_date') {
                $checkInDate = $queryItems[0][2];
                $checkOutDate = $queryItems[1][2];
                $reservations = Reservation::where('reservation_status', '!=', 'Cancelled')->where(
                    function ($query) use ($checkInDate, $checkOutDate) {
                        $query->whereBetween('check_in_date', [$checkInDate, $checkOutDate]) // Conflito no checkin
                            ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate]) // Conflito no checkout
                            ->orWhere(
                                function ($nested) use ($checkInDate, $checkOutDate) { // Conflito total
                                    $nested->where('check_in_date', '<=', $checkInDate)
                                        ->where('check_out_date', '>=', $checkOutDate);
                                }
                            );
                    }
                )->get();

                $reservedPropertyIds = $reservations->pluck('property_id')->toArray();

                $propertiesQuery = Property::whereNotIn('property_id', $reservedPropertyIds);
                $properties = $propertiesQuery->with('photos', 'property_taxes', 'property_amenities')->get();

                return new PropertyCollection($properties);
            }
        } else {
            if ($queryItems[sizeof($queryItems) - 2][0] == 'check_in_date' && $queryItems[sizeof($queryItems) - 1][0] == 'check_out_date') {
                $checkInDate = $queryItems[sizeof($queryItems) - 2][2];
                $checkOutDate = $queryItems[sizeof($queryItems) - 1][2];
                $reservations = Reservation::where('reservation_status', '!=', 'Cancelled')->where(
                    function ($query) use ($checkInDate, $checkOutDate) {
                        $query->whereBetween('check_in_date', [$checkInDate, $checkOutDate]) // Conflito no checkin
                            ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate]) // Conflito no checkout
                            ->orWhere(
                                function ($nested) use ($checkInDate, $checkOutDate) { // Conflito total
                                    $nested->where('check_in_date', '<=', $checkInDate)
                                        ->where('check_out_date', '>=', $checkOutDate);
                                }
                            );
                    }
                )->get();

                $reservedPropertyIds = $reservations->pluck('property_id')->toArray();

                $propertiesQuery = Property::whereNotIn('property_id', $reservedPropertyIds);
                
                $filteredQueryItems = array_slice($queryItems, 0, -2);

                $properties = $propertiesQuery
                ->where($filteredQueryItems)
                ->with('photos', 'property_taxes', 'property_amenities')
                ->get();
                return new PropertyCollection($properties);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $request)
    {
        $property = Property::create($request->all());
        return new PropertyResource($property);
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
