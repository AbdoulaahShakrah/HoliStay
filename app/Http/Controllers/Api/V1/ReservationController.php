<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ReservationRequest;
use App\Http\Requests\v1\UpdateReservationRequest;
use App\Http\Resources\v1\ReservationCollection;
use App\Http\Resources\V1\ReservationResource;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationRequest $request)
    {
        $payment = Reservation::create($request->all());
        return new ReservationResource($payment);
    }


    //http://127.0.0.1:8000/api/v1/reservations/by-client?client_id=10
    public function getByClientId(Request $request)
    {

        $clientId = $request->query('client_id');
        $reservations = Reservation::where('client_id', $clientId)->with('property', 'client')->get();

        if ($reservations->isEmpty()) {
            return response()->json([
                'message' => 'No reservations found for this client.'
            ], 404);
        }
        
        return new ReservationCollection($reservations);
    }

    public function getByPropertyId(Request $request)
    {

        $clientId = $request->query('property_id');
        $reservations = Reservation::where('property_id', $clientId)->with(['property.photos', 'property.property_amenities', 'client'])->get();

        if ($reservations->isEmpty()) {
            return response()->json([
                'message' => 'No reservations found for this property.'
            ], 404);
        }


        return new ReservationCollection($reservations);
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
    public function update(UpdateReservationRequest $request, $id)
    {
        $property = Reservation::findOrFail($id);
        $property->update($request->all());
        return new ReservationResource($property);
    }
}
