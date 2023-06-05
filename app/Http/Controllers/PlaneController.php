<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlanesResource;
use App\Models\Planes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PlaneController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->only('show', 'store', 'update', 'delete');
    }

    public function index()
    {
        $planes = Planes::all();

        return PlanesResource::collection($planes);
    }

    public function show($id)
    {
        $plane = Planes::findOrFail($id);
        return new PlanesResource($plane);
    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pesawat' => 'required',
            'owner' => 'required'
        ]);

        if ($request->file) {
            $validated = $request->validate([
                'image' => 'mimes:jpg,jpeg,png|max:100000'
            ]);

            $fileName = $this->generateRandomString();
            $extension = $request->file->extension();

            Storage::putFileAs('image', $request->file, $fileName . '.' . $extension);

            $request['image'] = $fileName . '.' . $extension;
            $request['owner'] = Auth::user()->id;

            $plane =  Planes::create($request->all());
        }

        $request['owner'] = Auth::user()->id;
        $plane =  Planes::create($request->all());

        return new PlanesResource($plane->loadMissing('owner'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pesawat' => 'required|string',
            'owner' => 'required'
        ]);

        $plane = Planes::findOrFail($id);
        $plane->update($request->all());

        return new PlanesResource($plane);
    }

    public function delete($id)
    {
        $plane = Planes::findOrFail($id);
        $plane->delete();

        return response()->json([
            'message' => 'plane deleted successfully'
        ]);
    }
}
