<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributePackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_package', function (Blueprint $table) {
            $table->foreignId("package_id")->index();
            $table->foreignId("attribute_id")->index();
            $table->foreign("package_id")->references('id')->on("packages")->onDelete('cascade')->onUpdate('cascade');
            $table->foreign("attribute_id")->references('id')->on("attributes");
            $table->primary(['package_id', 'attribute_id']);
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
        Schema::dropIfExists('attribute_package');
    }
}
