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
            $table->string("name", 255);
            $table->string("url", 255);
            $table->string("short_description", 250)->nullable();
            $table->string("unit_code", 100);
            $table->bigInteger("seen_times")->default(0);
            $table->integer("vat");
            $table->integer("weight");
            $table->text("dimensions");
            $table->text("description")->nullable();
            $table->string("seo_title");
            $table->string("seo_keywords");
            $table->string("seo_description");
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
