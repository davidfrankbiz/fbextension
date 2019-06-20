<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColoumsCookies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('cookies', function (Blueprint $table) {
             $table->string('city')->nullable(); 
             $table->string('country')->nullable(); 
             $table->string('zipcode')->nullable();
             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cookies', function (Blueprint $table) {           
             
        });
    }
}
