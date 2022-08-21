<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryPackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_package', function (Blueprint $table) {
            $table->foreignId("category_id")->index();
            $table->foreignId("package_id")->index();
            $table->foreign("category_id")->references('id')->on("categories");
            $table->foreign("package_id")->references('id')->on("packages")->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['category_id', 'package_id']);
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
        Schema::dropIfExists('category_package');
    }
}
