<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('users')) {
            return;
        }

        // 1) Tambah kolom role HANYA jika belum ada. Data lama tidak disentuh.
        //    Default 'user' = hak akses paling kecil (aman bila ada baris yang terlewat).
        if (! Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->enum('role', ['admin', 'user'])->default('user')->after('nama');
            });
        }

        // 2) Karena sebelumnya SEMUA akun bisa mengelola data, pastikan minimal satu admin
        //    agar Anda tidak terkunci. Hanya berjalan bila belum ada admin sama sekali:
        //    pakai username 'admin' jika ada, jika tidak pakai akun dengan id terkecil.
        if (DB::table('users')->where('role', 'admin')->doesntExist()) {
            $target = DB::table('users')->where('username', 'admin')->value('id')
                ?? DB::table('users')->min('id');

            if ($target) {
                DB::table('users')->where('id', $target)->update(['role' => 'admin']);
            }
        }
    }

    public function down(): void
    {
        // Sengaja kosong agar data pengguna tidak ikut berubah/terhapus saat rollback.
    }
};
