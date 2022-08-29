<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255)->nullable();
            $table->string("url", 255)->nullable();
            $table->string("short_description", 250)->nullable();
            $table->string("unit_code", 100)->nullable();
            $table->bigInteger("seen_times")->default(0);
            $table->integer("vat")->nullable();
            $table->integer("weight")->nullable();
            $table->text("dimensions")->nullable();
            $table->text("description")->nullable();
            $table->string("seo_title")->nullable();
            $table->string("seo_keywords")->nullable();
            $table->string("seo_description")->nullable();
            $table->integer("price");
            $table->foreignId("discount_id")->nullable();
            $table->boolean("pre_made")->default(true);
            $table->boolean("active")->default(true);
            $table->timestamps();

            $table->foreign("discount_id")->references("id")->on("discounts")->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
