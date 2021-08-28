@extends('layout.app', ['title'=>'Ajouter un livre'])

@section('content')
    <form method="POST" action="{{ route('book.create') }}">
        @csrf

        <div class="form-group">
            <label for="title" class="form-label">{{ __('Titre') }}</label>

            <input id="title" type="title" class="form-control @error('title') is-invalid @enderror" name="title"
                   value="{{ $title ?? old('title') }}" required autocomplete="title" autofocus>

            @error('title')
                <p class="invalid-feedback" role="alert">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-submit">
                {{ __('Enregistrer le nouveau mot de passe') }}
            </button>
        </div>
    </form>
@endsection
