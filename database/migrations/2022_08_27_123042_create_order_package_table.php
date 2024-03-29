<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_package', function (Blueprint $table) {
            $table->id();
            $table->foreignId("order_id");
            $table->foreignId("package_id");
            $table->integer("quantity")->default(1);
            $table->string("package_name")->nullable();
            $table->integer("package_price")->nullable();
            $table->integer("package_price_no_vat")->nullable();
            $table->timestamps();

            $table->foreign("order_id")->references("id")->on("orders")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("package_id")->references("id")->on("packages")->onDelete("cascade")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_package');
    }
}
