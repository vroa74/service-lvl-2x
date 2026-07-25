<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use App\Livewire\Profile\UpdateProfileInformationForm;
use App\Livewire\Service\Edit as ServiceEdit;
use App\Livewire\TestButton;

class LivewireServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Registrar nuestros componentes personalizados
        Livewire::component('profile.update-profile-information-form', UpdateProfileInformationForm::class);
        Livewire::component('service.edit', ServiceEdit::class);
        Livewire::component('test-button', TestButton::class);
    }
} 