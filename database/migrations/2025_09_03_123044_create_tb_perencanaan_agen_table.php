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
        Schema::create('tb_perencanaan_agen', function (Blueprint $table) {
            $table->increments('pa_id');
            
            $table->date('pa_tgl_awal');
            $table->date('pa_tgl_akhir');
            $table->string('pa_kondisi', 100)->nullable();
            
            $table->char('w_id', 4);
            $table->unsignedInteger('pklan_id');
            
            $table->integer('pa_jumlah');

            // timestamps custom
            $table->timestamp('pa_created_at')->useCurrent();
            $table->timestamp('pa_updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->dateTime('pa_deleted_at')->nullable();

            // foreign keys
            $table->foreign('w_id')
                  ->references('w_id')
                  ->on('tb_wilayah')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

            $table->foreign('pklan_id')
                  ->references('pklan_id')
                  ->on('tb_pangkalan')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_perencanaan_agen');
    }
};
