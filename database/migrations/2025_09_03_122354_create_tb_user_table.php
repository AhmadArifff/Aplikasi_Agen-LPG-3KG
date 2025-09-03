<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_user', function (Blueprint $table) {
            $table->increments('u_id');
            $table->string('u_username', 255)->unique();
            $table->string('u_password', 255);
            $table->string('u_fullname', 255)->nullable();
            $table->string('u_role', 100)->nullable();
            $table->string('u_referensi', 255)->nullable();
            $table->string('u_email', 255)->unique();
            $table->string('u_nik', 20)->nullable();
            $table->string('u_nama', 255)->nullable();
            $table->string('u_tempat_lahir', 255)->nullable();
            $table->date('u_tanggal_lahir')->nullable();
            $table->string('u_jenis_kelamin', 50)->nullable();
            $table->string('u_provinsi', 255)->nullable();
            $table->string('u_kota', 255)->nullable();
            $table->string('u_kelurahan', 255)->nullable();
            $table->string('u_kecamatan', 255)->nullable();
            $table->string('u_kodepos', 10)->nullable();

            // timestamps + soft delete
            $table->timestamp('u_created_at')->useCurrent();
            $table->timestamp('u_updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->dateTime('u_deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_user');
    }
};
