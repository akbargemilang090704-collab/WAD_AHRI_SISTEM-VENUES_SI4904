<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel instruktur sudah ada di database lama (venue_olahraga.sql).
        // Struktur di bawah disamakan dengan tabel asli dan hanya dibuat jika belum ada.
        if (!Schema::hasTable('instruktur')) {
            Schema::create('instruktur', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('nama', 100);
                $table->string('no_lisensi', 50)->unique();
                $table->string('keahlian', 50);
                $table->string('telepon', 20);
                $table->enum('status', ['Aktif', 'Nonaktif'])->default('Aktif');
                $table->timestamp('created_at')->useCurrent();
            });
        }
    }

    public function down(): void
    {
        // Sengaja kosong agar data lama tidak terhapus.
    }
};
