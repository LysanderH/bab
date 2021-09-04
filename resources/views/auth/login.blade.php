@extends('layout.app', ['title'=>'Se connecter'])

@section('content')
    <header class="header">
        <div class="header__wrapper">
            <h1 class="header__heading">Book a Book <span class="sr-only">- Se connecter</span></h1>
        </div>
    </header>
    <main>
        <form method="POST" action="{{ route('login') }}" class="form">
            @csrf

            <div class="form-group">
                <label for="email"
                       class="form-label">{{ __('E-Mail Address') }}</label>

                <input id="email" type="email"
                       class="form-control @error('email') is-invalid @enderror" name="email"
                       value="{{ old('email') }}" required autocomplete="email" placeholder="info@lysander-hans.com"
                       autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">{{ __('Mot de passe') }}</label>

                <input id="password" type="password"
                       class="form-control @error('password') is-invalid @enderror" name="password"
                       required autocomplete="current-password" placeholder="Mot de passe">
                <span class="form-check__checkbox"></span>

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember"
                           id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Se souvenir de moi') }}
                    </label>
                    <span class="form-check-checkbox"></span>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-submit">
                    {{ __('Se connecter') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="link" href="{{ route('password.request') }}">
                        {{ __('Vous avez oublié votre mot de passe?') }}
                    </a>
                @endif
                <a href="/register" class="link">Je n’ai pas de compte.</a>
            </div>
        </form>
    </main>
@endsection
