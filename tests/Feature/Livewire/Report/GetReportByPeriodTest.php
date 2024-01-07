<?php

namespace Tests\Feature\Livewire\Report;

use App\Livewire\Report\GetReportByPeriod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class GetReportByPeriodTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(GetReportByPeriod::class)
            ->assertStatus(200);
    }
}
