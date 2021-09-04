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
    <main>
        @include('layout.success')
        @include('layout.error')
        <form method="POST" action="{{ route('admin.setting.update') }}" enctype="multipart/form-data"
              class="form">
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

            <div class="mb-0 form-group">
                <button type="submit" class="btn btn-submit">
                    {{ __('Enregistrer') }}
                </button>
            </div>
        </form>
    </main>
@endsection
