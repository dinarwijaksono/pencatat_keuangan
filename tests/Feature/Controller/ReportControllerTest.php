<?php

namespace Tests\Feature\Controller;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReportControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->seed(UserSeeder::class);
        $user = User::select('*')->first();
        $this->actingAs($user);
    }

    public function test_index(): void
    {
        $response = $this->get('/Report');

        $response->assertStatus(200);
        $response->assertSeeText("Pemasukan vs Pengeluaran (Semua periode)");
        $response->assertSeeText("Deskripsi");
        $response->assertSeeText("Pemasukan");
        $response->assertSeeText("Pengeluaran");
    }
}
