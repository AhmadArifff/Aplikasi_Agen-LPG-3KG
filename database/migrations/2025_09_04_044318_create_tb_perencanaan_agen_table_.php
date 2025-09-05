<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_perencanaan_agen_rekap', function (Blueprint $table) {
            $table->id('pa_id');
            $table->unsignedInteger('pa_pangkalan_id'); // Changed to unsignedInteger
            $table->string('pa_bulan', 7);
            $table->enum('pa_status', ['Cashless', 'Non-Cashless'])->default('Cashless');
            $table->integer('pa_alokasi')->default(0);

            // Kolom distribusi per hari (01-31)
            for ($i = 1; $i <= 31; $i++) {
                $col = str_pad($i, 2, '0', STR_PAD_LEFT);
                $table->integer("pa_$col")->default(0);
            }

            $table->timestamps();

            // Foreign key
            $table->foreign('pa_pangkalan_id')
                  ->references('pklan_id')
                  ->on('tb_pangkalan')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_perencanaan_agen_rekap');
    }
};
