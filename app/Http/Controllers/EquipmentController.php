<?php

namespace App\Http\Controllers;

use App\Actions\EquipmentStoreAction;
use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EquipmentController extends Controller
{
    protected int $perPage = 5;

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        return response(EquipmentResource::collection(Equipment::search($request)->paginate($this->perPage)));
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
