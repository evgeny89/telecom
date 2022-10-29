<?php

namespace App\Models;

use App\Helpers\AppHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
