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
        Schema::create('tb_pangkalan', function (Blueprint $table) {
            $table->increments('pklan_id');
            $table->char('w_id', 4);

            $table->string('pklan_nama_pangkalan', 255);
            $table->string('pklan_alamat', 255);
            $table->string('pklan_no_telepon', 20);

            // timestamps custom
            $table->timestamp('pklan_created_at')->useCurrent();
            $table->timestamp('pklan_updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->dateTime('pklan_deleted_at')->nullable();

            // foreign key
            $table->foreign('w_id')
                  ->references('w_id')
                  ->on('tb_wilayah')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pangkalan');
    }
};
