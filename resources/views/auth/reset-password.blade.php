@extends('layout.app', ['title'=>'Réinitialiser le mot de passe'])

@section('content')
    <header class="header">
        <div class="header__wrapper">
            <h1 class="header__heading">Book a Book <span class="sr-only">- Se connecter</span></h1>
        </div>
    </header>
    <main>
        <form method="POST" action="{{ route('password.update') }}" class="form">
            @csrf

            <input type="hidden" name="token" value="{{ $request->token }}">

            <div class="form-group row">
                <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>

                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                       value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="form-group row">
                <label for="password" class="form-label">{{ __('Password') }}</label>

                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                       name="password" required autocomplete="new-password">

                @error('password')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="form-group row">
                <label for="password-confirm"
                       class="form-label">{{ __('Confirm Password') }}</label>

                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                       autocomplete="new-password">
            </div>

            <div class="mb-0 form-group row">
                <button type="submit" class="btn btn-submit">
                    {{ __('Enregistrer le nouveau mot de passe') }}
                </button>
            </div>
        </form>
    </main>
@endsection
