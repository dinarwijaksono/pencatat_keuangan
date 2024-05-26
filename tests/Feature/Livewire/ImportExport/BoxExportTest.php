<?php

namespace Tests\Feature\Livewire\ImportExport;

use App\Livewire\ImportExport\BoxExport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class BoxExportTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(BoxExport::class)
            ->assertStatus(200);
    }
}
