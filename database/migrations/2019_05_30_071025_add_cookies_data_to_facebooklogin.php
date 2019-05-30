<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCookiesDataToFacebooklogin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('facebook_login', function (Blueprint $table) {
             $table->longText('cookies_data')->nullable(); 
             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facebooklogin', function (Blueprint $table) {
            //
        });
    }
}
