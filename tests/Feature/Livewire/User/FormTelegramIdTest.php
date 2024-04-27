<?php

namespace Tests\Feature\Livewire\User;

use App\Livewire\ItemComponen\Alert;
use App\Livewire\User\FormTelegramId;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class FormTelegramIdTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->seed(UserSeeder::class);

        $user = User::select('*')->first();

        $this->actingAs($user);
    }

    public function test_renders_successfully()
    {
        Livewire::test(FormTelegramId::class)
            ->assertStatus(200);
    }

    public function test_do_set_telegram_id_success()
    {
        Livewire::test(FormTelegramId::class)
            ->set('chatId', '1234')
            ->call('doSetTelegramId')
            ->assertDispatchedTo(Alert::class, 'alertSuccess');

        $this->assertDatabaseHas('token_telegram_bots', [
            'user_id' => auth()->user()->id,
            'chat_id' => '1234'
        ]);
    }

    public function test_do_set_telegram_id_validate_is_error()
    {
        $response = Livewire::test(FormTelegramId::class)
            ->call('doSetTelegramId');

        $response->assertHasErrors([
            'chatId' => 'required'
        ]);
    }

    public function test_do_delete_telegram_id()
    {
        Livewire::test(FormTelegramId::class)
            ->set('chatId', '1234')
            ->call('doSetTelegramId');

        $this->assertDatabaseHas('token_telegram_bots', [
            'user_id' => auth()->user()->id,
            'chat_id' => '1234'
        ]);

        Livewire::test(FormTelegramId::class)
            ->call('doDeletetelegramId')
            ->assertDispatchedTo(Alert::class, 'alertSuccess');

        $this->assertDatabaseMissing('token_telegram_bots', [
            'user_id' => auth()->user()->id,
            'chat_id' => '1234'
        ]);
    }
}
