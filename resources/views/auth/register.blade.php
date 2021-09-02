@extends('layout.app', ['title'=>'Créer un compte'])

@section('content')
    <header class="header">
        <div class="header__wrapper">
            <h1 class="header__heading">Book a Book <span class="sr-only">- Se connecter</span></h1>
        </div>
    </header>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="form">
        @csrf

        <div class="form-group">
            <label for="name" class="form-label">{{ __('Name') }}</label>

            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                   value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="nom prénom">

            @error('name')
                <p class="invalid-feedback" role="alert">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="form-group">
            <label for="group" class="form-label">{{ __('Groupe') }}</label>

            <input id="group" type="text" class="form-control @error('group') is-invalid @enderror" name="group"
                   value="{{ old('group') }}" required autocomplete="group" placeholder="2384">

            @error('group')
                <p class="invalid-feedback" role="alert">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="form-group">
            <label for="avatar" class="form-label">{{ __('Image de profil') }}</label>

            <div class="preview" id="preview">
                <p>Aucune image a été téléversée.</p>
            </div>

            <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar"
                   value="{{ old('avatar') }}" accept=".png, .jpg, .jpeg" required>

            @error('avatar')
                <p class="invalid-feedback" role="alert">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="form-label">{{ __('Adresse mail') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                   value="{{ old('email') }}" required autocomplete="email" placeholder="example@mail.com">

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
                       name="password" required autocomplete="new-password" placeholder="Mot de passe">

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
                   placeholder="Confirmer le mot de passe" required>
        </div>

        <div class="form-group mb-0">
            <button type="submit" class="btn btn-submit">
                {{ __('Créer un compte') }}
            </button>
            <a href="/login" class="link">J’ai déjà un compte.</a>
        </div>
    </form>
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
