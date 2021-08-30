@extends('layout.app', ['title'=>'Créer un compte'])

@section('content')
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
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

            <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar"
                   value="{{ old('avatar') }}" accept=".png, .jpg, .jpeg" required>
            <div class="preview" id="preview">
                <p>Aucune image a été téléversée.</p>
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
                       name="password" required autocomplete="new-password">

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

            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>

        <div class="form-group mb-0">
            <button type="submit" class="btn btn-submit">
                {{ __('Créer un compte') }}
            </button>
        </div>
    </form>
    <a href="/login" class="link">J’ai déjà un compte.</a>
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
