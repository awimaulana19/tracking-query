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
        Schema::create('md_wilayah_administrasi', function (Blueprint $table) {
            $table->string('kode', 13)->primary()->unique();
            $table->char('k1', 2)->default('00');
            $table->char('k2', 2)->default('00');
            $table->char('k3', 2)->default('00');
            $table->char('k4', 4)->default('0000');
            $table->string('provinsi', 64)->nullable();
            $table->string('kabkota', 64)->nullable();
            $table->string('kecamatan', 64)->nullable();
            $table->string('deskel', 64)->nullable();
            $table->dateTime('iat')->useCurrent();
            $table->timestamp('uat')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('md_wilayah_administrasi');
    }
};
