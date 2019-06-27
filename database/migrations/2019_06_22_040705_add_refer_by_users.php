<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReferByUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('register_user', function (Blueprint $table) {
             $table->tinyInteger('refer_by')->nullable();              
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('register_user', function (Blueprint $table) {
             $table->tinyInteger('refer_by')->nullable();              
        });
    }
}
