<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->foreignId("courier_id")->nullable();
            $table->string("order_number", 50);
            $table->enum("payment_type", ["cash", "card"]);
            $table->boolean("paid");
            $table->integer("total_price");
            $table->integer("total_price_no_vat");
            $table->integer("delivery_price");
            $table->text("user_shipping_details");
            $table->date("order_sent_at")->nullable();
            $table->date("order_delivered_at")->nullable();
            $table->string("tracking_code")->nullable();
            $table->text("comment")->nullable();
            $table->string("checksum")->nullable();
            $table->boolean("manual")->default(false);
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("courier_id")->references("id")->on("couriers")->onDelete("cascade")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
