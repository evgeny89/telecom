<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipmentTypeRequest;
use App\Http\Requests\UpdateEquipmentTypeRequest;
use App\Http\Resources\EquipmentTypeResource;
use App\Models\EquipmentType;
use Illuminate\Http\Response;

class EquipmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
         return response(new \App\Http\Resources\EquipmentType(EquipmentType::all()));
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
     * @param StoreEquipmentTypeRequest $request
     * @return Response
     */
    public function store(StoreEquipmentTypeRequest $request): Response
    {
        $type = new EquipmentType($request->validated());
        $type->save();

        return response(new EquipmentTypeResource($type));
    }

    /**
     * Display the specified resource.
     *
     * @param EquipmentType $equipmentType
     * @return Response
     */
    public function show(EquipmentType $equipmentType): Response
    {
        return response(new EquipmentTypeResource($equipmentType));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param EquipmentType $equipmentType
     * @return Response
     */
    public function edit(EquipmentType $equipmentType): Response
    {
        return response("", 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEquipmentTypeRequest $request
     * @param EquipmentType $equipmentType
     * @return Response
     */
    public function update(UpdateEquipmentTypeRequest $request, EquipmentType $equipmentType): Response
    {
        return response($equipmentType->update($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param EquipmentType $equipmentType
     * @return Response
     */
    public function destroy(EquipmentType $equipmentType): Response
    {
        return response($equipmentType->delete());
    }
}
