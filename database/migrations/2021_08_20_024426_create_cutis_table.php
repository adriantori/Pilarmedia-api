<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCutisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cutis', function (Blueprint $table) {
            $table->id('cuti_id');
            $table->date('cuti_in');
            $table->date('cuti_out');
            $table->enum('cuti_verified',['menunggu','disetujui', 'ditolak']);
            $table->enum('cuti_type',['cuti', 'sakit']);
            $table->string('cuti_reason');            
            $table->timestamps();
        });

        Schema::table('cutis', function (Blueprint $table) {
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
        Schema::dropIfExists('cutis');
    }
}
