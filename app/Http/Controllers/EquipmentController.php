<?php

namespace App\Http\Controllers;

use App\Actions\EquipmentStoreAction;
use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EquipmentController extends Controller
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
        return EquipmentResource::collection(Equipment::search($request)->paginate($this->perPage))->response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEquipmentRequest $request
     * @return Response
     */
    public function store(StoreEquipmentRequest $request): Response
    {
        $action = new EquipmentStoreAction($request);
        return response($action->handler());
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
