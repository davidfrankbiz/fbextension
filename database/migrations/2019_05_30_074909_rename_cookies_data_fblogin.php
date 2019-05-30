<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameCookiesDataFblogin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('facebook_login', function(Blueprint $table) {
            $table->renameColumn('cookies_data', 'cookis_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('facebook_login', function(Blueprint $table) {
            $table->renameColumn('cookies_data', 'cookis_data');
        });
    }
}
