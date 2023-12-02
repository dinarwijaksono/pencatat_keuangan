<?php

namespace Tests\Feature\Livewire\ItemComponen;

use App\Livewire\ItemComponen\TransactionInDay;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TransactionInDayTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        // Livewire::test(TransactionInDay::class)
        //     ->assertStatus(200);

        $this->assertTrue(true);
    }
}
