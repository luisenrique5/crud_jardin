<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersRols extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UsersRols', function (Blueprint $table) {
            $table->unsignedInteger('idUsers');
            $table->unsignedInteger('idRol');

            $table->foreign('idUsers', 'UserForeign')->references('id')->on('users');
            $table->foreign('idRol', 'RolForeign')->references('id')->on('Rols');

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
        Schema::table('UsersRols', function (Blueprint $table) {
            $table->dropForeign('UserForeign');
            $table->dropColumn('RolForeign');
        });
        Schema::dropIfExists('UsersRols');
    }
}
