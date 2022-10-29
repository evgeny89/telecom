<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;
use Illuminate\Http\Response;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response(EquipmentResource::collection(Equipment::all()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return response("", 404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEquipmentRequest $request
     * @return Response
     */
    public function store(StoreEquipmentRequest $request): Response
    {
        $type = new Equipment($request->validated());
        $type->save();

        return response(new EquipmentResource($type));
    }

    /**
     * Display the specified resource.
     *
     * @param Equipment $equipment
     * @return Response
     */
    public function show(Equipment $equipment): Response
    {
        return response(new EquipmentResource($equipment));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Equipment $equipment
     * @return Response
     */
    public function edit(Equipment $equipment): Response
    {
        return response("", 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEquipmentRequest $request
     * @param Equipment $equipment
     * @return Response
     */
    public function update(UpdateEquipmentRequest $request, Equipment $equipment): Response
    {
        return response($equipment->update($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Equipment $equipment
     * @return Response
     */
    public function destroy(Equipment $equipment): Response
    {
        return response($equipment->delete());
    }
}
