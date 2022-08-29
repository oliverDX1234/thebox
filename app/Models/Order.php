<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";

    protected $fillable = [
        "user_id",
        "courier_id",
        "total_price",
        "paid",
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
