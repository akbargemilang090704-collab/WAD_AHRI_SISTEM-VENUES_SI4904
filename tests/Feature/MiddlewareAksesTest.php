<?php

namespace Tests\Feature;

use App\Models\Lapangan;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

/**
 * Pengujian middleware guest, auth, throttle, dan role.
 *
 * AMAN: tes ini membuat tabel sendiri di SQLite :memory: dan otomatis dilewati
 * jika koneksi bukan SQLite memori, sehingga database MySQL venue_olahraga tidak tersentuh.
 */
class MiddlewareAksesTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (config('database.default') !== 'sqlite' || config('database.connections.sqlite.database') !== ':memory:') {
            $this->markTestSkipped('Tes hanya boleh berjalan di SQLite :memory: (cek phpunit.xml).');
        }

        Schema::create('users', function ($t) {
            $t->increments('id');
            $t->string('username')->unique();
            $t->string('password');
            $t->string('nama');
            $t->string('role')->default('user');
        });
        Schema::create('lapangan', function ($t) {
            $t->increments('id'); $t->string('kode'); $t->string('nama'); $t->string('jenis_olahraga');
            $t->string('jenis_permukaan'); $t->string('ukuran'); $t->string('status_fisik');
        });
        Schema::create('alat', function ($t) {
            $t->increments('id'); $t->string('kode'); $t->string('nama'); $t->string('kategori');
            $t->string('kondisi'); $t->integer('stok'); $t->decimal('tarif_sewa', 10, 2);
        });
        Schema::create('instruktur', function ($t) {
            $t->increments('id'); $t->string('nama'); $t->string('no_lisensi'); $t->string('keahlian');
            $t->string('telepon'); $t->string('status');
        });
        Schema::create('pelanggan', function ($t) {
            $t->increments('id'); $t->string('nama'); $t->string('email'); $t->string('telepon');
            $t->text('alamat')->nullable(); $t->string('level_member');
        });
    }

    private function akun(string $role): User
    {
        return User::create(['username' => $role . '1', 'password' => 'rahasia123', 'nama' => ucfirst($role), 'role' => $role]);
    }

    // ---------- guest ----------
    public function test_tamu_bisa_membuka_halaman_login(): void
    {
        $this->get('/login')->assertOk();
    }

    public function test_user_yang_sudah_login_dialihkan_dari_halaman_login(): void
    {
        $this->actingAs($this->akun('admin'))->get('/login')->assertRedirect('/dashboard');
    }

    // ---------- auth ----------
    public function test_tamu_ditolak_dan_dialihkan_ke_login(): void
    {
        foreach (['/dashboard', '/admin/dashboard', '/user/dashboard', '/lapangan', '/users'] as $url) {
            $this->get($url)->assertRedirect('/login');
        }
    }

    // ---------- login & pengalihan per role ----------
    public function test_login_admin_diarahkan_ke_dashboard_admin(): void
    {
        $this->akun('admin');
        $this->post('/login', ['username' => 'admin1', 'password' => 'rahasia123'])->assertRedirect('/admin/dashboard');
    }

    public function test_login_user_diarahkan_ke_dashboard_user(): void
    {
        $this->akun('user');
        $this->post('/login', ['username' => 'user1', 'password' => 'rahasia123'])->assertRedirect('/user/dashboard');
    }

    public function test_route_dashboard_meneruskan_sesuai_role(): void
    {
        $this->actingAs($this->akun('admin'))->get('/dashboard')->assertRedirect('/admin/dashboard');
        auth()->logout();
        $this->actingAs($this->akun2())->get('/dashboard')->assertRedirect('/user/dashboard');
    }

    private function akun2(): User
    {
        return User::create(['username' => 'user2', 'password' => 'rahasia123', 'nama' => 'User2', 'role' => 'user']);
    }

    // ---------- throttle ----------
    public function test_login_salah_berulang_terkena_throttle_429(): void
    {
        $this->akun('admin');

        for ($i = 1; $i <= 5; $i++) {
            $this->post('/login', ['username' => 'admin1', 'password' => 'salah'])->assertStatus(302);
        }

        $this->post('/login', ['username' => 'admin1', 'password' => 'salah'])
            ->assertStatus(429)
            ->assertSee('Terlalu banyak percobaan login');
    }

    // ---------- role:admin ----------
    public function test_admin_bisa_membuka_semua_halaman_admin(): void
    {
        $this->actingAs($this->akun('admin'));
        foreach (['/admin/dashboard', '/lapangan', '/lapangan/create', '/instruktur', '/alat', '/pelanggan', '/users', '/users/create'] as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_admin_tidak_boleh_membuka_area_user(): void
    {
        $this->actingAs($this->akun('admin'))->get('/user/dashboard')->assertForbidden();
    }

    // ---------- role:user ----------
    public function test_user_bisa_membuka_halaman_yang_diizinkan(): void
    {
        $this->actingAs($this->akun('user'));
        foreach (['/user/dashboard', '/user/lapangan', '/user/instruktur', '/user/alat'] as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_user_ditolak_403_di_semua_halaman_admin(): void
    {
        // Route model binding berjalan sebelum role, jadi /lapangan/{id}/edit butuh ID yang ada agar 403 (bukan 404).
        Lapangan::create([
            'kode' => 'LP-1', 'nama' => 'Lapangan A', 'jenis_olahraga' => 'Futsal',
            'jenis_permukaan' => 'Vinyl', 'ukuran' => '25x15', 'status_fisik' => 'Baik',
        ]);

        $this->actingAs($this->akun('user'));
        foreach (['/admin/dashboard', '/lapangan', '/lapangan/create', '/lapangan/1/edit', '/instruktur', '/alat', '/pelanggan', '/users', '/users/create'] as $url) {
            $this->get($url)->assertForbidden();
        }
    }

    // ---------- pemblokiran di sisi server (bukan sekadar menyembunyikan tombol) ----------
    public function test_user_tidak_bisa_tambah_ubah_hapus_data_lewat_request_langsung(): void
    {
        $lap = Lapangan::create([
            'kode' => 'LP-1', 'nama' => 'Lapangan A', 'jenis_olahraga' => 'Futsal',
            'jenis_permukaan' => 'Vinyl', 'ukuran' => '25x15', 'status_fisik' => 'Baik',
        ]);

        $this->actingAs($this->akun('user'));

        $this->post('/lapangan', [
            'kode' => 'LP-2', 'nama' => 'Lapangan B', 'jenis_olahraga' => 'Futsal',
            'jenis_permukaan' => 'Vinyl', 'ukuran' => '25x15', 'status_fisik' => 'Baik',
        ])->assertForbidden();
        $this->assertDatabaseCount('lapangan', 1);

        $this->put("/lapangan/{$lap->id}", ['nama' => 'Diretas'])->assertForbidden();
        $this->assertDatabaseHas('lapangan', ['id' => $lap->id, 'nama' => 'Lapangan A']);

        $this->delete("/lapangan/{$lap->id}")->assertForbidden();
        $this->assertDatabaseHas('lapangan', ['id' => $lap->id]);

        // user tidak boleh menaikkan role dirinya lewat form pengguna
        $this->put('/users/1', ['username' => 'user1', 'nama' => 'X', 'role' => 'admin'])->assertForbidden();
        $this->assertDatabaseMissing('users', ['role' => 'admin']);
    }

    public function test_admin_tidak_bisa_menurunkan_role_akunnya_sendiri(): void
    {
        $admin = $this->akun('admin');
        $this->actingAs($admin)
            ->put("/users/{$admin->id}", ['username' => 'admin1', 'nama' => 'Admin', 'role' => 'user'])
            ->assertSessionHas('error');
        $this->assertDatabaseHas('users', ['id' => $admin->id, 'role' => 'admin']);
    }
}
