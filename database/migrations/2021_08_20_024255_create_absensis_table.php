<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id('absen_id');
            $table->dateTime('absen_in');
            $table->dateTime('absen_out');
            $table->timestamps();
        });
        
        
        Schema::table('absensis', function (Blueprint $table) {
            $table->unsignedBigInteger('kary_id');
            $table->foreign('kary_id')->references('kary_id')->on('karyawans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensis');
    }
}
