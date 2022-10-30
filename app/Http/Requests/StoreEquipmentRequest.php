<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class StoreEquipmentRequest extends FormRequest
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
            "equipments" => [
                "required",
                "array",
                function ($attribute, $value, $fail) {
                    if (Arr::isAssoc($value)) {
                        $fail("{$attribute} не может быть объектом");
                    }
                }
            ],
            "equipments.*" => "required|array",
        ];
    }
}
