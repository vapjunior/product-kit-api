<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Kit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\KitResource;

class KitController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kits = Kit::all();

        $success['kits'] = KitResource::collection($kits);
        $message = 'Kit retrivied successfully';
        $code = 200;
        
        return $this->sendResponse($success, $message, $code);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:25',
            'description' => 'required|max:255',
            'ml_categorie_id' => 'required',
        ]);

        if($validator->fails()) {
            $message = 'Validation Error.';
            return $this->sendError($message, $validator->errors());
        }

        $kit = Kit::create($data);

        $success['kit'] = new KitResource($kit);
        $message = 'Kit Created Successfully';
        $code = 201;

        return $this->sendResponse($success, $message, $code);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function show(Kit $kit)
    {
        $success['kit'] = new KitResource($kit);
        $message = 'Kit Retrevied Successfully';
        $code = 200;

        return $this->sendResponse($success, $message, $code);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function edit(Kit $kit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kit $kit)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:25',
            'description' => 'required|max:255',
            'ml_categorie_id' => 'required',
        ]);

        if($validator->fails()) {
            $message = 'Validation Error.';
            return $this->sendError($message, $validator->errors());
        }

        $kit->update($data);
        
        $success['kit'] = new KitResource($kit);
        $message = 'Kit Updated Successfully';

        return $this->sendResponse($success, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kit $kit)
    {
        $kit->delete();

        $message = 'Kit Destroyed Successfully';

        return $this->sendResponse(null, $message);
    }
}
