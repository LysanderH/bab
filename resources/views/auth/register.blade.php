@extends('layout.app', ['title'=>'Créer un compte'])

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name" class="form-label">{{ __('Name') }}</label>

            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                   value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
                <p class="invalid-feedback" role="alert">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="form-group">
            <label for="group" class="form-label">{{ __('Groupe') }}</label>

            <input id="group" type="text" class="form-control @error('group') is-invalid @enderror" name="group"
                   value="{{ old('group') }}" required autocomplete="group" autofocus>

            @error('group')
                <p class="invalid-feedback" role="alert">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                   value="{{ old('email') }}" required autocomplete="email">

            @error('email')
                <p class="invalid-feedback" role="alert">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">{{ __('Password') }}</label>

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
                   class="form-label">{{ __('Confirm Password') }}</label>

            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                   autocomplete="new-password">
        </div>

        <div class="form-group mb-0">
            <button type="submit" class="btn btn-submit">
                {{ __('Créer un compte') }}
            </button>
        </div>
    </form>
@endsection
