<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('password', 100);
            $table->enum('roles', ['admin', 'user'])->default("user");
            $table->text("admin_settings")->default('{"layout":{"type":"vertical","width":"fluid","sidebartype":"dark","topbar":"dark","loader":"false"}}');
            $table->string("phone", 20);
            $table->string("address", 100);
            $table->enum("gender", ["male", "female"]);
            $table->integer("city");
            $table->date("dob");
            $table->string("image")->nullable();
            $table->boolean("active")->default(true);
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
        Schema::dropIfExists('users');
    }
}
