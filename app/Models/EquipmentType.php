<?php

namespace App\Models;

use App\Helpers\AppHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\EquipmentType
 *
 * @property int $id
 * @property string $name
 * @property string $mask
 * @property string $pattern
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Equipment[] $equipments
 * @property-read int|null $equipments_count
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentType query()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentType whereMask($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentType wherePattern($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentType whereUpdatedAt($value)
 */
class EquipmentType extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "mask",
    ];

    /*
    * =============================================
    * RELATIONSHIP
    * =============================================
    */

    /**
     * Get the equipments for the type.
     * @return HasMany
     */
    public function equipments(): HasMany
    {
        return $this->hasMany(Equipment::class);
    }

    /*
    * =============================================
    * MUTATORS
    * =============================================
    */

    public function setMaskAttribute($value)
    {
        $this->attributes['mask'] = $value;
        $this->attributes['pattern'] = AppHelper::makePattern($value);
    }
}
