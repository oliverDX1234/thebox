<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name", 100);
            $table->string("url", 100);
            $table->foreignId("supplier_id");
            $table->string("short_description", 250);
            $table->string("unit_code", 100);
            $table->integer("vat");
            $table->bigInteger("seen_times")->default(0);
            $table->integer("weight");
            $table->json("dimensions")->nullable();
            $table->integer("price");
            $table->integer("price_supplier");
            $table->text("description");
            $table->string("seo_keywords");
            $table->string("seo_description");
            $table->boolean("active")->default(true);

            $table->foreign("supplier_id")->references("id")->on("suppliers");
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
        Schema::dropIfExists('products');
    }
}
