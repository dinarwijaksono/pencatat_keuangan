<?php

namespace Tests\Feature\Livewire\Report;

use App\Livewire\Report\ShowReportByPeriod;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ShowReportByPeriodTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->seed(UserSeeder::class);
        $user = User::select('*')->where('username', 'test')->first();

        $this->actingAs($user);
    }

    /** @test */
    public function renders_successfully()
    {
        Livewire::test(ShowReportByPeriod::class)
            ->assertStatus(200);
    }
}
