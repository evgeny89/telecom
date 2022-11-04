<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipmentTypeRequest;
use App\Http\Requests\UpdateEquipmentTypeRequest;
use App\Http\Resources\EquipmentTypeResource;
use App\Models\EquipmentType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EquipmentTypeController extends Controller
{
    /**
     * pagination value
     *
     * @var int
     */
    protected int $perPage = 5;

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
         return EquipmentTypeResource::collection(EquipmentType::search($request)->paginate($this->perPage))->response();
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
