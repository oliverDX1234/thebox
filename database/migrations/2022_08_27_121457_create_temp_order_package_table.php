<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempOrderPackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_order_package', function (Blueprint $table) {
            $table->id();
            $table->foreignId("temp_order_id");
            $table->foreignId("package_id");
            $table->integer("quantity");
            $table->string("package_name");
            $table->integer("package_price");
            $table->integer("package_price_no_vat");
            $table->timestamps();

            $table->foreign("temp_order_id")->references("id")->on("temp_orders");
            $table->foreign("package_id")->references("id")->on("packages");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temp_order_package');
    }
}
