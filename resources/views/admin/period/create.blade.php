@extends('layout.app', ['title'=>'Commancer une nouvelle période'])

@section('content')
    <header class="header">
        <div class="header__wrapper">
            <h1 class="header__heading"><a href="{{ route('admin.dashboard') }}" class="header__link">Book a Book</a>
                <span class="sr-only">- Commancer une nouvelle période</span>
            </h1>
            <x-admin-menu />
        </div>
    </header>
    <main>
        @include('layout.success')
        @include('layout.error')
        <form method="POST" action="{{ route('admin.period.store') }}" enctype="multipart/form-data"
              class="form">
            @csrf

            <div class="form-group">
                <label for="start" class="form-label">{{ __('Début') }}</label>

                <input id="start" type="date" class="form-control @error('start') is-invalid @enderror" name="start"
                       value="{{ old('start') }}" required autocomplete="start" placeholder="2384">

                @error('start')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="form-group">
                <label for="end" class="form-label">{{ __('Fin') }}</label>

                <input id="end" type="date" class="form-control @error('end') is-invalid @enderror" name="end"
                       value="{{ old('end') }}" required autocomplete="end" placeholder="2384">

                @error('end')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="form-group">
                <label for="deadline" class="form-label">{{ __('Date butoir pour les commqndes') }}</label>

                <input id="deadline" type="date" class="form-control @error('deadline') is-invalid @enderror"
                       name="deadline"
                       value="{{ old('deadline') }}" required autocomplete="deadline" placeholder="2384">

                @error('deadline')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-0 form-group">
                <button type="submit" class="btn btn-submit">
                    {{ __('Débuter une nouvelle période') }}
                </button>
            </div>
        </form>
    </main>
@endsection
