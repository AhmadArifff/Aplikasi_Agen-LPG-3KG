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
        Schema::create('tb_wilayah', function (Blueprint $table) {
            $table->char('w_id', 4)->primary()->unique();
            $table->string('w_nama_kabupaten_atau_kota', 255);

            // timestamps custom
            $table->timestamp('w_created_at')->useCurrent();
            $table->timestamp('w_updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->dateTime('w_deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_wilayah');
    }
};
