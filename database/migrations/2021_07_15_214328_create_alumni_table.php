<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kampus_id')->references('id')->on('kampus')->onDelete('cascade')->onUpdate('cascade');
            $table->string('foto');
            $table->string('nama_lengkap', 100);
            $table->string('jenis_kelamin', 50);
            $table->text('alamat');
            $table->string('jurusan', 100);
            $table->string('fakultas', 100);
            $table->string('angkatan', 50);
            $table->string('alumni', 100);
            $table->string('no_wa', 100);
            $table->string('akun_ig', 100);
            $table->string('url', 50);
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
        Schema::dropIfExists('alumni');
    }
}
