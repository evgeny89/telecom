<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        "equipment_type_id",
        "serial_number",
        "description",
    ];

    /*
    * =============================================
    * RELATIONSHIP
    * =============================================
    */

    /**
     * Get the type that owns the equipment.
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(EquipmentType::class);
    }

}
