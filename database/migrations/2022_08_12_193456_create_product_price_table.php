<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_price', function (Blueprint $table) {

            $table->foreignId("product_id");
            $table->integer("price");
            $table->integer("supplier_price");
            $table->integer("discounted_price")->nullable();
            $table->dateTime("discount_valid_until")->nullable();
            $table->timestamps();

            $table->foreign("product_id")->references("id")->on("products")->onDelete("cascade")->onUpdate("cascade");

            $table->primary("product_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_price');
    }
}
