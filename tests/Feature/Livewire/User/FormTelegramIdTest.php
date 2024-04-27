<?php

namespace Tests\Feature\Livewire\User;

use App\Livewire\User\FormTelegramId;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class FormTelegramIdTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(FormTelegramId::class)
            ->assertStatus(200);
    }
}
