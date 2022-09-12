<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Order extends Model implements Searchable
{
    use HasFactory;

    protected $table = "orders";

    protected $fillable = [
        "user_id",
        "courier_id",
        "total_price",
        "paid",
        "tracking_code",
        "total_price_no_vat",
        "payment_type",
        "order_sent_at",
        "order_delivered_at",
        "delivery_price"
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function (Order $query) {
            if(!$query->order_number){
                $lastItem = Order::latest()->first();

                if($lastItem){
                    $lastId = explode("-", $lastItem->order_number)[1];

                    $query->order_number = "Order-".(++$lastId);
                }else{
                    $query->order_number = "Order-"."0000001";
                }
            }
        });
    }


    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            $this->order_number,
            "/admin/order/".$this->id
        );
    }

    public function getUserShippingDetailsAttribute($value)
    {
        $details = json_decode($value);

        $details->city = City::findOrFail($details->city);

        return $details;
    }

    public function packages(): BelongsToMany
    {

        return $this->belongsToMany(Package::class)->withPivot(["quantity", "package_name", "package_price", "package_price_no_vat"]);
    }

    public function courier(): BelongsTo
    {
        return $this->belongsTo(Courier::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
