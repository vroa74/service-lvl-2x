<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'rfc' => ['nullable', 'string', 'max:13', Rule::unique('users')->ignore($user->id)],
            'curp' => ['nullable', 'string', 'max:18', Rule::unique('users')->ignore($user->id)],
            'direction' => ['nullable', 'string', 'max:250'],
            'position' => ['nullable', 'string', 'max:35'],
            'sex' => ['nullable', 'in:masculino,femenino'],
            'lvl' => ['nullable', 'string', 'max:10'],
            'tipo' => ['required', 'integer', 'in:1,2,3'],
            'status' => ['boolean'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'rfc' => $input['rfc'] ?? null,
                'curp' => $input['curp'] ?? null,
                'direction' => $input['direction'] ?? null,
                'position' => $input['position'] ?? null,
                'sex' => $input['sex'] ?? null,
                'lvl' => $input['lvl'] ?? null,
                'tipo' => $input['tipo'],
                'status' => $input['status'] ?? true,
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'rfc' => $input['rfc'] ?? null,
            'curp' => $input['curp'] ?? null,
            'direction' => $input['direction'] ?? null,
            'position' => $input['position'] ?? null,
            'sex' => $input['sex'] ?? null,
            'lvl' => $input['lvl'] ?? null,
            'tipo' => $input['tipo'],
            'status' => $input['status'] ?? true,
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
