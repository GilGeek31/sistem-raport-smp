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
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->foreignId('mapel_id')->constrained('mapels')->onDelete('cascade');
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('tahun_ajaran_id')->constrained('tahun_ajarans')->onDelete('cascade');
            $table->decimal('nilai_akhir', 5, 2);
            $table->text('deskripsi')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('gurus')->onDelete('set null');
            $table->timestamps();

            // satu siswa hanya boleh punya satu nilai per mapel per kelas per semester
            $table->unique(['siswa_id', 'mapel_id', 'tahun_ajaran_id',],  'unik_nilai_siswa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
