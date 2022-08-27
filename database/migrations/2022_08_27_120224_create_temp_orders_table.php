<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_orders', function (Blueprint $table) {
            $table->id();
            $table->string("checksum", 50);
            $table->foreignId("user_id");
            $table->foreignId("courier_id");
            $table->integer("total_price");
            $table->integer("total_price_no_vat");
            $table->integer("delivery_price");
            $table->text("user_shipping_details");
            $table->text("comment")->nullable();
            $table->boolean("success")->default(0);
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
        Schema::dropIfExists('temp_orders');
    }
}
