<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Image;
use function PHPUnit\Framework\fileExists;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index', [
            // 'users' => User::paginate(2),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'group' => ['required', 'string', 'max:4'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => 'string',
            'avatar' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'group' => $validated['group'],
            'password' => Hash::make($validated['password']),
        ]);

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

            $user->update([
                'avatar' => $avatarName,
            ]);
        }

        Password::sendResetLink($request->only(['email']));

        $request->session()->flash('success', 'L’utilisateur à bien été ajouté.');

        return redirect(route('admin.user.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.user.show', [
            'user' => User::with('orders.books', 'orders.status')->where('id', $id)->first(),
            'statuses' => Status::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
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
                Rule::unique('users')->ignore($user),
            ],
            'avatar' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

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

        return redirect(route('admin.user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        User::destroy($user->id);

        $request->session()->flash('success', 'L’utilisateur à bien été supprimé.');

        return redirect()->back();
    }
}
