<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Equipment
 *
 * @property int $id
 * @property int $equipment_type_id
 * @property string $serial_number
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\EquipmentType|null $type
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereEquipmentTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereUpdatedAt($value)
 */
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
