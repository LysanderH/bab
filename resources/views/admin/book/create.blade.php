@extends('layout.app', ['title'=>'Ajouter un livre'])

@section('content')
    <header class="header">
        <div class="header__wrapper">
            <h1 class="header__heading"><a href="{{ route('admin.dashboard') }}" class="header__link">Book a Book</a>
                <span class="sr-only">- Ajouter un livre</span>
            </h1>
            <x-admin-menu />
        </div>
    </header>
    <main>
        @include('layout.success')
        @include('layout.error')

        <form method="POST" action="{{ route('admin.book.store') }}" enctype="multipart/form-data" class="form">
            @csrf

            <div class="form-group">
                <label for="ISBN" class="form-label">{{ __('ISBN') }}</label>

                <input id="ISBN" type="text" class="form-control @error('ISBN') is-invalid @enderror" name="ISBN"
                       value="{{ $ISBN ?? old('ISBN') }}" required autocomplete="ISBN" autofocus
                       placeholder="978-2-7433-0482-9">

                @error('ISBN')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="form-group">
                <label for="title" class="form-label">{{ __('Titre') }}</label>

                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                       value="{{ $title ?? old('title') }}" required autocomplete="title"
                       placeholder="Règles typographiques">

                @error('title')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="form-group">
                <label for="author" class="form-label">{{ __('Auteur') }}</label>

                <input id="author" type="text" class="form-control @error('author') is-invalid @enderror" name="author"
                       value="{{ $author ?? old('author') }}" required autocomplete="author"
                       placeholder="Imprimerie Nationale">

                @error('author')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="form-group">
                <label for="category" class="form-label">{{ __('Option') }}</label>

                <select id="category" class="form-control @error('category') is-invalid @enderror"
                        name="category"
                        required>
                    @foreach ($categories as $cat)

                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>

                @error('category')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="form-group">
                <label for="bac" class="form-label">{{ __('Option') }}</label>

                <select id="bac" class="form-control @error('bac') is-invalid @enderror"
                        name="bac"
                        required>
                    @foreach ($bacs as $bac)

                        <option value="{{ $bac->id }}">{{ $bac->name }}</option>
                    @endforeach
                </select>

                @error('bac')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="form-group">
                <label for="cover" class="form-label">{{ __('Image de profil') }}</label>

                <input id="cover" type="file" class="form-control @error('cover') is-invalid @enderror" name="cover"
                       value="{{ old('cover') }}" accept=".png, .jpg, .jpeg" required>
                <div class="preview" id="preview">
                    <p>Aucune image a été téléversée.</p>
                </div>

                @error('cover')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="form-group">
                <label for="stock" class="form-label">{{ __('Stock') }}</label>

                <input id="stock" type="number" min="0" max="10000"
                       class="form-control @error('stock') is-invalid @enderror"
                       name="stock"
                       value="{{ $stock ?? old('stock') }}" required placeholder="0">

                @error('stock')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="form-group">
                <label for="price" class="form-label">{{ __('Prix') }}</label>

                <input id="price" type="number" step="any" min="0" max="1000"
                       class="form-control @error('price') is-invalid @enderror"
                       name="price"
                       value="{{ $price ?? old('price') }}" required placeholder="0">

                @error('price')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="form-group">
                <label for="excerpt" class="form-label">{{ __('Résumé') }}</label>

                <textarea id="excerpt" class="form-control @error('excerpt') is-invalid @enderror" name="excerpt"
                          required>{{ $excerpt ?? old('excerpt') }}</textarea>

                @error('excerpt')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-submit">
                    {{ __('Enregistrer le livre') }}
                </button>
            </div>
        </form>
    @endsection
</main>

@section('styles')
    @livewireStyles
@endsection

@section('scripts')
    @livewireScripts

    <script>
        const cover = document.querySelector('#cover');
        const preview = document.querySelector('#preview');

        cover.addEventListener('change', function(e) {
            preview.innerHTML = '';

            const image = document.createElement('img');
            image.src = URL.createObjectURL(event.target.files[0]);

            preview.appendChild(image);
        })
    </script>
@endsection
