<?php

namespace Tests\Feature;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AksesPelangganTest extends TestCase
{
    use RefreshDatabase;

    private function user(string $role): User
    {
        return User::factory()->create(['role' => $role]);
    }

    private function pelanggan(): Pelanggan
    {
        return Pelanggan::create([
            'nama' => 'Budi', 'email' => 'budi@example.com', 'telepon' => '0812',
            'level_member' => 'Basic', 'alamat' => 'Bandung',
        ]);
    }

    private function payload(array $o = []): array
    {
        return array_merge([
            'nama' => 'Baru', 'email' => 'baru@example.com', 'telepon' => '0813',
            'level_member' => 'Gold', 'alamat' => 'Jakarta',
        ], $o);
    }

    public function test_tamu_diarahkan_ke_login(): void
    {
        $this->get('/pelanggan')->assertRedirect('/login');
        $this->get('/pelanggan/create')->assertRedirect('/login');
        $this->post('/pelanggan', $this->payload())->assertRedirect('/login');
    }

    public function test_login_berhasil_dan_gagal(): void
    {
        $u = User::factory()->create(['email' => 'a@a.com', 'password' => 'rahasia123']);

        $this->post('/login', ['email' => 'a@a.com', 'password' => 'salah'])
            ->assertSessionHasErrors('email');
        $this->assertGuest();

        $this->post('/login', ['email' => 'a@a.com', 'password' => 'rahasia123'])
            ->assertRedirect('/pelanggan');
        $this->assertAuthenticatedAs($u);
    }

    public function test_logout(): void
    {
        $this->actingAs($this->user('viewer'))->post('/logout')->assertRedirect('/login');
        $this->assertGuest();
    }

    public function test_viewer_hanya_boleh_lihat(): void
    {
        $p = $this->pelanggan();
        $v = $this->user('viewer');

        $this->actingAs($v)->get('/pelanggan')->assertOk()->assertDontSee('Tambah Pelanggan')->assertDontSee('Hapus');
        $this->actingAs($v)->get('/pelanggan/create')->assertForbidden();
        $this->actingAs($v)->post('/pelanggan', $this->payload())->assertForbidden();
        $this->actingAs($v)->get("/pelanggan/{$p->id}/edit")->assertForbidden();
        $this->actingAs($v)->put("/pelanggan/{$p->id}", $this->payload())->assertForbidden();
        $this->actingAs($v)->delete("/pelanggan/{$p->id}")->assertForbidden();
        $this->assertDatabaseCount('pelanggans', 1);
    }

    public function test_staff_boleh_tambah_edit_tapi_tidak_hapus(): void
    {
        $p = $this->pelanggan();
        $s = $this->user('staff');

        $this->actingAs($s)->get('/pelanggan')->assertOk()->assertSee('Tambah Pelanggan')->assertSee('Edit')->assertDontSee('Hapus');
        $this->actingAs($s)->post('/pelanggan', $this->payload())->assertRedirect('/pelanggan');
        $this->actingAs($s)->get("/pelanggan/{$p->id}/edit")->assertOk();
        $this->actingAs($s)->put("/pelanggan/{$p->id}", $this->payload(['email' => 'budi@example.com', 'nama' => 'Budi Baru']))
            ->assertRedirect('/pelanggan');
        $this->assertDatabaseHas('pelanggans', ['id' => $p->id, 'nama' => 'Budi Baru']);

        $this->actingAs($s)->delete("/pelanggan/{$p->id}")->assertForbidden();
        $this->assertDatabaseHas('pelanggans', ['id' => $p->id]);
    }

    public function test_admin_boleh_semua(): void
    {
        $p = $this->pelanggan();
        $a = $this->user('admin');

        $this->actingAs($a)->get('/pelanggan')->assertOk()->assertSee('Hapus');
        $this->actingAs($a)->post('/pelanggan', $this->payload())->assertRedirect('/pelanggan');
        $this->actingAs($a)->delete("/pelanggan/{$p->id}")->assertRedirect('/pelanggan');
        $this->assertDatabaseMissing('pelanggans', ['id' => $p->id]);
    }
}
