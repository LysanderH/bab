@extends('layout.app', ['title'=>'Préférences'])

@section('content')
    <h1>Préférences</h1>
    <x-admin-menu />
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
