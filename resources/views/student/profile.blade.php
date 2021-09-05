@extends('layout.app', ['title'=>'Profil'])

@section('content')
    <header class="header">
        <div class="header__wrapper">
            <h1 class="header__heading"><a href="{{ route('admin.dashboard') }}" class="header__link">Book a Book</a>
                <span class="sr-only">- Profil</span>
            </h1>
            <x-admin-menu />
        </div>
    </header>
    <main>
        @include('layout.success')
        @include('layout.error')
        <form method="POST" action="{{ route('student.user.edit', ['user' => $user]) }}" enctype="multipart/form-data"
              class="form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name" class="form-label">{{ __('Nom prénom') }}</label>

                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                       value="{{ old('name') ?? $user->name }}" required autocomplete="name" autofocus
                       placeholder="nom prénom">

                @error('name')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="form-group">
                <label for="group" class="form-label">{{ __('Groupe') }}</label>

                <input id="group" type="text" class="form-control @error('group') is-invalid @enderror" name="group"
                       value="{{ old('group') ?? $user->group }}" required autocomplete="group" placeholder="2384">

                @error('group')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="form-group">
                <label for="avatar" class="form-label">{{ __('Image de profil') }}</label>

                <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar"
                       value="{{ old('avatar') ?? $user->avatar }}" accept=".png, .jpg, .jpeg">
                <div class="preview" id="preview">
                    <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="">
                </div>

                @error('avatar')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">{{ __('Adresse mail') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                       value="{{ old('email') ?? $user->email }}" required autocomplete="email"
                       placeholder="example@mail.com">

                @error('email')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">{{ __('Mot de passe') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" autocomplete="new-password"
                           value="{{ old('password') }}" placeholder="Mot de passe">

                    @error('password')
                        <p class="invalid-feedback" role="alert">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm"
                       class="form-label">{{ __('Confirmer le mot de passe') }}</label>

                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                       placeholder="Confirmer le mot de passe">
            </div>

            <div class="mb-0 form-group">
                <button type="submit" class="btn btn-submit">
                    {{ __('Enregistrer') }}
                </button>
            </div>
        </form>
        <form action="{{ route('student.user.destroy') }}" method="POST" class="form">
            @csrf
            @method('PUT')
            <div class="mb-0 form-group">
                <button type="submit" class="btn btn-submit">
                    {{ __('Supprimer mon compte') }}
                </button>
            </div>
        </form>
    </main>
@endsection


@section('scripts')
    <script>
        const cover = document.querySelector('#avatar');
        const preview = document.querySelector('#preview');

        cover.addEventListener('change', function(e) {
            preview.innerHTML = '';

            const image = document.createElement('img');
            image.src = URL.createObjectURL(event.target.files[0]);

            preview.appendChild(image);
        })
    </script>
@endsection
