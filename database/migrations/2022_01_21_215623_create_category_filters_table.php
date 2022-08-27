<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_filter', function (Blueprint $table) {
            $table->foreignId("category_id")->index();
            $table->foreignId("filter_id")->index();
            $table->foreign("category_id")->references('id')->on("categories")->onDelete('cascade')->onUpdate('cascade');
            $table->foreign("filter_id")->references('id')->on("filters");
            $table->timestamps();
            $table->primary(['category_id', 'filter_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_filters');
    }
}
