<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\DeletePropertyRequest;
use App\Http\Requests\V1\StorePropertyRequest;
use App\Http\Requests\v1\UpdatePropertyRequest;
use App\Http\Resources\V1\PropertyCollection;
use App\Http\Resources\V1\PropertyResource;
use App\Models\Photo;
use App\Models\Property;
use App\Models\PropertyAmenity;
use App\Models\Reservation;
use App\Services\V1\PropertyFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new PropertyFilter();
        $queryItems = $filter->transform($request); // Filtros do request

        if (!$this->hasCheckInAndOutDates($queryItems)) {
            return response()->json(['error' => 'Datas de check-in e check-out são obrigatórias'], 400);
        }

        [$checkInDate, $checkOutDate] = $this->extractCheckInAndOutDates($queryItems);
        $reservedPropertyIds = $this->getReservedPropertyIds($checkInDate, $checkOutDate);

        $propertiesQuery = Property::whereNotIn('property_id', $reservedPropertyIds);

        // Se houver mais filtros, aplicamos
        $filteredQueryItems = $this->removeCheckInAndOutDates($queryItems);
        if (!empty($filteredQueryItems)) {
            $propertiesQuery->where($filteredQueryItems);
        }

        $properties = $propertiesQuery
            ->with(['photos', 'property_taxes', 'property_amenities'])
            ->get();

        return new PropertyCollection($properties);
    }


    private function hasCheckInAndOutDates(array $queryItems): bool
    {
        return count($queryItems) >= 2 &&
            $queryItems[array_key_last($queryItems) - 1][0] === 'check_in_date' &&
            $queryItems[array_key_last($queryItems)][0] === 'check_out_date';
    }

    private function extractCheckInAndOutDates(array &$queryItems): array
    {
        $checkIn = array_splice($queryItems, -2, 1)[0][2];
        $checkOut = array_splice($queryItems, -1, 1)[0][2];
        return [$checkIn, $checkOut];
    }

    private function getReservedPropertyIds(string $checkInDate, string $checkOutDate): array
    {
        return Reservation::where('reservation_status', '!=', 'Cancelled')
            ->where(function ($query) use ($checkInDate, $checkOutDate) {
                $query->whereBetween('check_in_date', [$checkInDate, $checkOutDate]) // Conflito no check-in
                    ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate]) // Conflito no check-out
                    ->orWhere(function ($nested) use ($checkInDate, $checkOutDate) { // Conflito total
                        $nested->where('check_in_date', '<=', $checkInDate)
                            ->where('check_out_date', '>=', $checkOutDate);
                    });
            })
            ->pluck('property_id')
            ->toArray();
    }

    private function removeCheckInAndOutDates(array $queryItems): array
    {
        return array_filter($queryItems, function ($filter) {
            return !in_array($filter[0], ['check_in_date', 'check_out_date']);
        });
    }

    public function categories()
    {
        $categories = Property::distinct()->orderBy('property_type')->pluck('property_type');
        return response()->json($categories);
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
    public function show($id)
    {
        $property = Property::with('photos', 'property_amenities', 'property_taxes', 'host')->find($id);
        if (!$property) {
            return response()->json(['message' => 'Property not found'], 404);
        }

        return new PropertyResource($property);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $request, $id)
    {
        $property = Property::findOrFail($id);

        // Atualizar os dados da propriedade
        $property->update($request->except('amenities', 'photos'));

        // Atualizar os amenities na tabela property_amenity
        $amenities = $request->amenities; // Array de amenity_ids enviados no request

        // Apagar os amenities antigos e adicionar os novos
        PropertyAmenity::where('property_id', $property->property_id)->delete();

        foreach ($amenities as $amenity_id) {
            PropertyAmenity::create([
                'property_id' => $property->property_id,
                'amenity_id' => $amenity_id
            ]);
        }

        return new PropertyResource($property);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeletePropertyRequest $request, $id)
    {
        $property = Property::findOrFail($id);
        $property->delete();
        return response()->json([
            'message' => 'Property deleted successfully',
            'property_id' => $id,
        ], 200);
    }

    /**
     * #################################### Functions for Host #######################################
     */

    /**
     * Display the properties from a host.
     */
    //http://127.0.0.1:8000/api/v1/properties-by-host?host_id=2
    public function propertiesByHostId(Request $request)
    {
        $hostId = $request->query('host_id');
        $properties = Property::where('host_id', $hostId)->with('photos', 'reservations')->get();

        if ($properties->isEmpty()) {
            return response()->json([
                'message' => 'No properties found for this host.'
            ], 404);
        }

        return new PropertyCollection($properties);
    }
}
