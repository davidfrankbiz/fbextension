<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCheckCookiesFacebookLogin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::table('facebook_login', function (Blueprint $table) {
           $table->string('checkCookies')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::table('facebook_login', function (Blueprint $table) {
           $table->string('checkCookies')->nullable();
        });
    }
}
