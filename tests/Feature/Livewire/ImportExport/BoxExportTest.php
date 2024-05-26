<?php

namespace Tests\Feature\Livewire\ImportExport;

use App\Livewire\ImportExport\BoxExport;
use App\Models\User;
use Database\Seeders\CategorySeeder;
use Database\Seeders\TransactionSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class BoxExportTest extends TestCase
{
    public $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(UserSeeder::class);
        $this->user = User::select('*')->first();
        $this->actingAs($this->user);

        $this->seed(CategorySeeder::class);
        $this->seed(CategorySeeder::class);
        $this->seed(CategorySeeder::class);
        $this->seed(CategorySeeder::class);

        $this->seed(TransactionSeeder::class);
    }

    public function test_renders_successfully()
    {
        Livewire::test(BoxExport::class)
            ->assertStatus(200);
    }

    public function test_do_export_success()
    {
        Livewire::test(BoxExport::class)
            ->call('doExport');

        $username = auth()->user()->username;
        $this->assertFileExists(__DIR__ . "/../../../../public/storage/Export/$username-transaction-export.csv");
    }
}
