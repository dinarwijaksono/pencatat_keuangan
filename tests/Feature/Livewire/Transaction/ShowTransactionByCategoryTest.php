<?php

namespace Tests\Feature\Livewire\Transaction;

use App\Livewire\Transaction\ShowTransactionByCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ShowTransactionByCategoryTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(ShowTransactionByCategory::class)
            ->assertStatus(200);
    }
}
