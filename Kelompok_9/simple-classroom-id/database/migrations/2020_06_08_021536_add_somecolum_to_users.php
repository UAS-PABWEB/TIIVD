<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomecolumToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum("roles", ["Admin", "User"])->default("User");
            $table->text("address")->nullable(); 
            $table->string("phone")->nullable(); 
            $table->string("avatar")->default("avatars/default.png");
            $table->enum("status", ["ACTIVE", "INACTIVE"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['roles', 'address', 'avatar', 'status']);
        });
    }
}
