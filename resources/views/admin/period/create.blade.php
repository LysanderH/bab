@extends('layout.app', ['title'=>'Commancer une nouvelle période'])

@section('content')
    <h1>Commancer une nouvelle période</h1>
    <form method="POST" action="{{ route('admin.period.store') }}" enctype="multipart/form-data">
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

            <input id="deadline" type="date" class="form-control @error('deadline') is-invalid @enderror" name="deadline"
                   value="{{ old('deadline') }}" required autocomplete="deadline" placeholder="2384">

            @error('deadline')
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
