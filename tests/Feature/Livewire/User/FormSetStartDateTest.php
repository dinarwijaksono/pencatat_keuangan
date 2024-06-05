<?php

namespace Tests\Feature\Livewire\User;

use App\Exceptions\ValidateExeption;
use App\Livewire\ItemComponen\Alert;
use App\Livewire\User\FormSetStartDate;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class FormSetStartDateTest extends TestCase
{
    public $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(UserSeeder::class);
        $this->user = User::select('*')->first();
        $this->actingAs($this->user);
    }

    public function test_renders_successfully()
    {
        Livewire::test(FormSetStartDate::class)
            ->assertStatus(200)
            ->assertSee('Tanggal Awal Periode')
            ->assertSeeHtml('<h3>Tanggal Awal Periode</h3>')
            ->assertSee('Simpan')
            ->assertSee($this->user->start_date);
    }


    public function test_do_set_start_date_failed_start_date_is_empty()
    {
        Livewire::test(FormSetStartDate::class)
            ->set('startDate', '')
            ->call('doSetStartDate')
            ->assertHasErrors(['startDate' => ['required']]);
    }

    public function test_do_set_start_date_failed_start_date_musk_numeric()
    {
        Livewire::test(FormSetStartDate::class)
            ->set('startDate', 'asdf')
            ->call('doSetStartDate')
            ->assertHasErrors(['startDate' => ['numeric']]);
    }

    public function test_do_set_start_date_failed_start_date_not_valid()
    {
        Livewire::test(FormSetStartDate::class)
            ->set('startDate', '100')
            ->call('doSetStartDate');

        $this->assertDatabaseMissing('users', [
            'id' => $this->user->id,
            'start_date' => 100
        ]);
    }

    public function test_do_set_start_date_failed_validate_exeption()
    {
        Livewire::test(FormSetStartDate::class)
            ->set('startDate', '100')
            ->call('doSetStartDate')
            ->assertDispatchedTo(Alert::class, 'alertFailed');
    }


    public function test_do_set_start_date_success()
    {
        Livewire::test(FormSetStartDate::class)
            ->set('startDate', '10')
            ->call('doSetStartDate')
            ->assertDispatchedTo(Alert::class, 'alertSuccess');

        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'start_date' => 10
        ]);
    }
}
