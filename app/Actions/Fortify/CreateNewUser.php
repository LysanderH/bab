<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Image;

use function PHPUnit\Framework\fileExists;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'group' => ['required', 'string', 'max:4'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'group' => $input['group'],
            'password' => Hash::make($input['password']),
        ]);

        if (fileExists($input['avatar'])) {
            $image = $input['avatar'];

            $destinationPath = public_path('/storage/avatars');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 666, true);
            }

            $imgFile = Image::make($image->getRealPath());
            $smallAvatar = Image::make($image->getRealPath());

            $avatarName = $user->id . '_avatar' . time() . '.jpg';

            $imgFile->fit(250, 250)->save($destinationPath . '/' . $avatarName);
            $smallAvatar->fit(50, 50)->save($destinationPath . '/small_' . $avatarName);

            $user->update([
                'avatar' => $avatarName,
            ]);
        }

        return $user;
    }
}
