<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Period;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Image;

use function PHPUnit\Framework\fileExists;

class UserUserController extends Controller
{
    public function edit(Request $request)
    {
        $user = User::where('id', $request->user()->id)->first();
        return view('student.profile', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'group' => ['required', 'string', 'max:4'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],
            'avatar' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($user->id !== $request->user()->id) {
            $request->session()->flash('error', 'Il vous est interdit de modifier cet utilisateur.');

            return redirect(route('student.dashboard'));
        }

        if (key_exists('avatar', $validated)) {
            if (fileExists($validated['avatar'])) {
                $image = $validated['avatar'];

                $destinationPath = public_path('/storage/avatars');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 666, true);
                }

                $imgFile = Image::make($image->getRealPath());
                $smallAvatar = Image::make($image->getRealPath());

                $avatarName = $user->id . '_avatar' . time() . '.jpg';

                $imgFile->fit(250, 250)->save($destinationPath . '/' . $avatarName);
                $smallAvatar->fit(50, 50)->save($destinationPath . '/small_' . $avatarName);
            }
        }

        $user = User::where('id', $user->id)->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'group' => $validated['group'],
            'avatar' => $avatarName ?? $user->avatar,
            'password' => isset($validated['password']) ? Hash::make($validated['password']) : $user->password,
        ]);

        $request->session()->flash('success', 'L’utilisateur à bien été modifié.');

        return redirect(route('student.dashboard'));
    }

    public function destroy(Request $request)
    {
        $user = User::with('orders')->where('id', $request->user()->id)->first();

        if (!$user) {
            return redirect()->back();
        }

        foreach ($user->orders as $order) {
            Order::where('id', $order->id)->delete();
        }

        $user->delete();

        $request->session()->flash('success', 'Votre compte a été supprimé.');

        return redirect(route('login'));
    }
}
