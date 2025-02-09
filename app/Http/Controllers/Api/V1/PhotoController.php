<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StorePhotoRequest;
use App\Http\Requests\v1\DeletePhotoRequest;
use App\Http\Resources\v1\PhotoResource;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
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
    //Try to do bulk store for many photos
    public function store(StorePhotoRequest $request)
    {
        $photo = Photo::create($request->all());
        return new PhotoResource($photo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeletePhotoRequest $request, $id)
    {
        $photo = Photo::findOrFail($id);
        $photo->delete();
        return response()->json([
            'message' => 'Photo deleted successfully',
            'photo_id' => $id,
        ], 200);
    }
}
