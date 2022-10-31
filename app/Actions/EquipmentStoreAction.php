<?php

namespace App\Actions;

use App\Contracts\ActionContract;
use App\Helpers\AppHelper;
use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;
use App\Models\EquipmentType;

class EquipmentStoreAction implements ActionContract
{
    protected array $data;
    protected array $result;

    const RULES = [
        "equipment_type_id" => "required|exists:equipment_types,id",
        "description" => "string",
        "serial_number" => [
            "required",
            "unique:equipment,serial_number",
        ],
    ];

    public function __construct($request)
    {
        $this->data = $request->equipments;
        $this->result = [
            'errors' => new \stdClass(),
            'success' => new \stdClass(),
        ];
    }

    /**
     * Handler for store equipments array
     *
     * @return array
     */
    public function handler(): array
    {
        foreach ($this->data as $key => $equipment) {
            $validated = $this->validate($equipment);

            $index = (string)$key;
            if (count($validated['errors'])) {
                $this->result['errors']->{$index} = $validated['errors'];
            } else {
                $equipment = new Equipment($validated['validated']);
                $equipment->save();
                $this->result['success']->{$index} = new EquipmentResource($equipment);
            }
        }

        return $this->result;
    }

    /**
     * Validate equipment
     *
     * @param array $equipment
     * @return array
     */
    protected function validate(array $equipment): array
    {
        $result = [
            "errors" => [],
            "validated" => [],
        ];

        $validator = \Validator::make($equipment, self::RULES);

        if ($validator->fails()) {
            $result['errors'] = $validator->errors()->all();
        } else {
            $result['validated'] = $validator->safe()->only(['equipment_type_id', 'description', 'serial_number']);
        }

        if (!$this->validateSerialNumber($equipment['serial_number'], $equipment['equipment_type_id'])) {
            $result['errors'][] = "serial number not against the mask";
        }

        return $result;
    }

    /**
     * Check the serial number against the type mask
     *
     * @param string $value
     * @param int $type_id
     * @return bool
     */
    protected function validateSerialNumber(string $value, int $type_id): bool
    {
        $type = EquipmentType::query()->find($type_id);
        if ($type) {
            return AppHelper::testString($value, $type->pattern);
        } else {
            return false;
        }
    }
}
