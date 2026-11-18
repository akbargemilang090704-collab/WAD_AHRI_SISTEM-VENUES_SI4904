<?php

namespace Tests\Feature;

use App\Models\AlatOlahraga;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AlatOlahragaTest extends TestCase
{
    use RefreshDatabase;

    public function test_inventory_page_displays_saved_equipment(): void
    {
        AlatOlahraga::create([
            'nama_alat' => 'Bola basket',
            'kondisi' => 'Layak Pakai',
            'tarif' => 15000,
        ]);

        $this->get(route('alat-olahraga.index'))
            ->assertOk()
            ->assertSee('Bola basket')
            ->assertSee('Rp 15.000 / hari');
    }

    public function test_equipment_can_be_created_updated_and_deleted(): void
    {
        $this->post(route('alat-olahraga.store'), [
            'nama_alat' => 'Raket badminton',
            'kondisi' => 'Layak Pakai',
            'tarif' => 10000,
        ])->assertRedirect(route('alat-olahraga.index'));

        $alat = AlatOlahraga::query()->firstOrFail();
        $this->assertDatabaseHas('alat_olahragas', ['id' => $alat->id, 'tarif' => 10000]);

        $this->put(route('alat-olahraga.update', $alat), [
            'nama_alat' => 'Raket badminton',
            'kondisi' => 'Rusak',
            'tarif' => 5000,
        ])->assertRedirect(route('alat-olahraga.index'));

        $this->assertDatabaseHas('alat_olahragas', ['id' => $alat->id, 'kondisi' => 'Rusak', 'tarif' => 5000]);

        $this->delete(route('alat-olahraga.destroy', $alat))
            ->assertRedirect(route('alat-olahraga.index'));

        $this->assertDatabaseMissing('alat_olahragas', ['id' => $alat->id]);
    }

    public function test_equipment_rejects_an_unsupported_condition(): void
    {
        $this->from(route('alat-olahraga.index'))
            ->post(route('alat-olahraga.store'), [
                'nama_alat' => 'Bola basket',
                'kondisi' => 'Tidak diketahui',
                'tarif' => 15000,
            ])
            ->assertRedirect(route('alat-olahraga.index'))
            ->assertSessionHasErrors('kondisi');

        $this->assertDatabaseCount('alat_olahragas', 0);
    }
}
