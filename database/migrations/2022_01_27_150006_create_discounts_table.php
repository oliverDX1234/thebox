<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->integer("value");
            $table->string("name", 255);
            $table->enum("type", ["fixed", "percent"]);
            $table->dateTime("start_date");
            $table->dateTime("end_date")->nullable()->default(null);
            $table->boolean("is_default")->default(false);
            $table->boolean("active");
            $table->boolean("specific")->default(false);
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
        Schema::dropIfExists('discounts');
    }
}
