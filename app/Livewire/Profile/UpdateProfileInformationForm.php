<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use App\Models\User;

class UpdateProfileInformationForm extends Component
{
    use WithFileUploads;

    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];

    /**
     * The new avatar for the user.
     *
     * @var mixed
     */
    public $photo;

    /**
     * Unique directions from database.
     *
     * @var array
     */
    public $uniqueDirections = [];

    /**
     * Unique positions from database.
     *
     * @var array
     */
    public $uniquePositions = [];

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->state = Auth::user()->withoutRelations()->toArray();
        
        // Obtener direcciones únicas
        $this->uniqueDirections = User::whereNotNull('direction')
            ->where('direction', '!=', '')
            ->distinct()
            ->pluck('direction')
            ->sort()
            ->values()
            ->toArray();
        
        // Obtener puestos únicos
        $this->uniquePositions = User::whereNotNull('position')
            ->where('position', '!=', '')
            ->distinct()
            ->pluck('position')
            ->sort()
            ->values()
            ->toArray();
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Laravel\Fortify\Contracts\UpdatesUserProfileInformation  $updater
     * @return void
     */
    public function updateProfileInformation(UpdatesUserProfileInformation $updater)
    {
        $this->resetErrorBag();

        $updater->update(
            Auth::user(),
            $this->photo
                ? array_merge($this->state, ['photo' => $this->photo])
                : $this->state
        );

        if (isset($this->photo)) {
            $this->photo = null;
        }

        // Guardar mensaje en session para mostrar en dashboard
        session()->flash('profile_updated', 'Las actualizaciones de perfil fueron hechas satisfactoriamente.');
        
        // Redirigir al dashboard después de guardar
        return redirect()->route('dashboard');
    }

    /**
     * Delete user's profile photo.
     *
     * @return void
     */
    public function deleteProfilePhoto()
    {
        Auth::user()->deleteProfilePhoto();

        // Guardar mensaje en session para mostrar en dashboard
        session()->flash('profile_updated', 'Foto de perfil eliminada correctamente.');
        
        // Redirigir al dashboard después de eliminar la foto
        return redirect()->route('dashboard');
    }

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return Auth::user();
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.profile.update-profile-information-form');
    }
} 