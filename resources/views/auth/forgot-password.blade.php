@extends('layout.app', ['title'=>'Mot de passe oublié'])

@section('content')
    <header class="header">
        <div class="header__wrapper">
            <h1 class="header__heading">Book a Book <span class="sr-only">- Se connecter</span></h1>
        </div>
    </header>
    <main>
        <form method="POST" action="{{ route('password.email') }}" class="form">
            @csrf
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="form-group">
                <label for="email" class="form-label">{{ __('Votre adresse email') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                       value="{{ old('email') }}" required autocomplete="email" placeholder="info@mail.com"
                       autofocus>

                @error('email')
                    <p class="invalid-feedback" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-submit">
                {{ __('Envoyé le lien') }}
            </button>
            <a href="/register" class="link">Je n’ai pas de compte</a>
            <a href="/login" class="link">Je me souvien de mon mot de passe</a>
        </form>
    </main>
@endsection
