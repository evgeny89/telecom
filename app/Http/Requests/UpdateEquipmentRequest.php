<?php

namespace App\Http\Requests;

use App\Helpers\AppHelper;
use App\Models\EquipmentType;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEquipmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "equipment_type_id" => "required|exists:equipment_types,id",
            "description" => "string",
            "serial_number" => [
                "required",
                "unique:equipment,serial_number",
                function ($attribute, $value, $fail) {
                    $type = EquipmentType::find($this->equipment_type_id);
                    if ($type) {
                        $result = AppHelper::testString($value, $type->pattern);
                        if (!$result) {
                            $fail("{$attribute} не соответствует выбранному типу оборудования");
                        }
                    }
                }
            ],
        ];
    }
}
