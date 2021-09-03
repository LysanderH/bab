@extends('layout.app', ['title'=>'Préférences'])

@section('content')
    <header class="header">
        <div class="header__wrapper">
            <h1 class="header__heading"><a href="{{ route('admin.dashboard') }}" class="header__link">Book a Book</a>
                <span class="sr-only">- Préférences</span>
            </h1>
            <x-admin-menu />
        </div>
    </header>
    <form method="POST" action="{{ route('admin.setting.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="account" class="form-label">{{ __('Compte en banque') }}</label>

            <input id="account" type="text" class="form-control @error('account') is-invalid @enderror" name="account"
                   value="{{ old('account') ?? ($account->content ?? '') }}" required autocomplete="account"
                   placeholder="BE44 7390 0983 0099">

            @error('account')
                <p class="invalid-feedback" role="alert">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="form-group mb-0">
            <button type="submit" class="btn btn-submit">
                {{ __('Débuter une nouvelle période') }}
            </button>
        </div>
    </form>

@endsection
