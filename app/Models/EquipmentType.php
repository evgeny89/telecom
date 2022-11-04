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

    protected array $searchFields = [
        "name",
        "mask",
    ];

    protected $perPage = 5;

    /*
    * =============================================
    * SCOPE
    * =============================================
    */

    public function scopeSearch($query, $request)
    {
        if ($request->has("q")) {
            $query->name($request->get('q'));
            $query->mask($request->get('q'));
        } else {
            foreach ($this->searchFields as $field) {
                if ($request->has($field)) {
                    $query->{$field}($request->get($field));
                }
            }
        }

        return $query;
    }

    public function scopeName($query, $search)
    {
        return $query->orWhere('name', 'LIKE', "%{$search}%");
    }

    public function scopeMask($query, $search)
    {
        return $query->orWhere('mask', 'LIKE', "%{$search}%");
    }

    /*
    * =============================================
    * RELATIONSHIP
    * =============================================
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
