<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->integer('nim')->primary();
            $table->string('nama');
            $table->integer('angkatan');
            $table->string('password');
            $table->string('token', 72)->unique()->nullable();
            $table->foreignId('prodiId')->unsigned();
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
        // Schema::table('mahasiswas', function (Blueprint $table) {
        //     $table->dropIfExists('token'); //
        // });
        Schema::dropIfExists('mahasiswas');
    }
};