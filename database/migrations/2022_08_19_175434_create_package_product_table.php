<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_product', function (Blueprint $table) {
            $table->foreignId("product_id");
            $table->foreignId("package_id");
            $table->integer("quantity")->default(1);//TODO review/implement/talk to Oli
            $table->timestamps();

            $table->primary(["product_id", "package_id"]);

            $table->foreign("product_id")->references("id")->on("products")->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('packages_products');
    }
}
