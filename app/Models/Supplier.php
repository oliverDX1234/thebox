<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\Supplier
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $address
 * @property int $city
 * @property string $phone
 * @property bool $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Product[] $products
 * @property-read int|null $products_count
 * @method static \Database\Factories\SupplierFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier query()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Supplier extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address',
        'active',
        'city_id',
        'phone',
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, "id", "city_id");
    }

    public function city(): HasOne
    {
        return $this->hasOne(City::class, "id", "city_id");
    }
}
