@extends('layout.app', ['title'=>'Mot de passe oublié'])

@section('content')
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="form-group">
            <label for="email" class="form-label">{{ __('Votre adresse email') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                   value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <p class="invalid-feedback" role="alert">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-submit">
            {{ __('Envoyé le lien') }}
        </button>
    </form>
@endsection
