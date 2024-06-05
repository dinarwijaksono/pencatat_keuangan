<?php

namespace App\Livewire\User;

use App\Exceptions\ValidateExeption;
use App\Livewire\ItemComponen\Alert;
use App\Services\UserService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class FormSetStartDate extends Component
{
    public $startDate;

    protected $userService;

    public function boot()
    {
        Log::withContext(['class' => FormSetStartDate::class]);

        $this->userService = App::make(UserService::class);
    }

    public function mount()
    {
        $this->startDate = auth()->user()->start_date;
    }

    public function getRules()
    {
        return [
            'startDate' => 'required|numeric'
        ];
    }

    public function doSetStartDate()
    {
        $this->validate();

        try {
            if ($this->startDate > 29 || $this->startDate < 1) {
                $this->dispatch('alertFailed', 'Gagal.')->to(Alert::class);

                throw new ValidateExeption("Start date is not valid.");
            }

            $this->userService->setStartDate(auth()->user()->id, $this->startDate);

            $this->dispatch('alertSuccess', 'Perubahan berhasil di simpan.')->to(Alert::class);

            Log::info('do set start date success');
        } catch (\Throwable $th) {
            Log::error('do set start date failed', [
                'message' => $th->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.user.form-set-start-date');
    }
}
