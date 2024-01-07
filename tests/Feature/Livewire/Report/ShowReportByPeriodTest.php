<?php

namespace Tests\Feature\Livewire\Report;

use App\Livewire\Report\ShowReportByPeriod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ShowReportByPeriodTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(ShowReportByPeriod::class)
            ->assertStatus(200);
    }
}
