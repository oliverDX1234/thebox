<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_product', function (Blueprint $table) {
            $table->foreignId("product_id")->index();
            $table->foreignId("attribute_id")->index();
            $table->foreign("product_id")->references('id')->on("products")->onDelete('cascade')->onUpdate('cascade');
            $table->foreign("attribute_id")->references('id')->on("attributes")->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['product_id', 'attribute_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_product');
    }
}
