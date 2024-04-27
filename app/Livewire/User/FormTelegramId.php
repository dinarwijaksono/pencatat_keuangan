<?php

namespace App\Livewire\User;

use App\Services\UserService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class FormTelegramId extends Component
{
    public $chatId;
    protected $userService;

    public function boot()
    {
        Log::withContext(['class' => FormTelegramId::class]);

        $this->userService = App::make(UserService::class);
    }

    public function getRules()
    {
        return [
            'chatId' => 'required|numeric'
        ];
    }

    public function doSetTelegramId()
    {
        $this->validate();

        try {
            $this->userService->setTelegramToken(auth()->user()->id, $this->chatId);

            Log::info('do set telegram id success');
        } catch (\Throwable $th) {
            Log::error('do set telegram id failed', [
                'message' => $th->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.user.form-telegram-id');
    }
}
