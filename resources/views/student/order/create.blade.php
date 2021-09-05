@extends('layout.app', ['title'=>'Commander'])

@section('content')
    <header class="header">
        <div class="header__wrapper">
            <h1 class="header__heading"><a href="{{ route('student.dashboard') }}" class="header__link">Book a Book</a>
                <span class="sr-only">- Commander</span>
            </h1>
            <x-user-menu />
        </div>
    </header>
    <main>
        @include('layout.success')
        @include('layout.error')
        <form action="{{ route('student.order.add') }}" method="POST" class="book-form">
            @csrf
            @foreach ($bacs as $bac)
                <ul class="bac__list">
                    <li class="bac__item">
                        <p class="bac__name">{{ $bac->name }}</p>
                        @if (count($bac->books))
                            <ul class="book-list">
                                @foreach ($bac->books->sortBy('title') as $book)
                                    <li class="book-list__item">
                                        <input type="checkbox" name="book[]" value="{{ $book->id }}"
                                               id="book-{{ $book->id }}" class="book-card__checkbox"
                                               {{ in_array($book->id, $selected) ? 'checked' : '' }}>
                                        <label for="book-{{ $book->id }}" class="book-card__label">
                                            <span class="book-card__heading" role="heading"
                                                  aria-level="2">{{ $book->title }}
                                            </span>
                                            <img src="{{ asset('storage/covers/small_' . $book->cover) }}"
                                                 alt="Foto de profil"
                                                 width="250"
                                                 height="250"
                                                 class="book-card__img">
                                            <span class="book-card__price">@currency($book->price)</span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>Pas de livres pour ce bac.</p>
                        @endif
                    </li>
                </ul>
            @endforeach
            <div class="form-group">
                <button type="submit" class="btn btn-submit">
                    {{ __('Continuer') }}
                </button>
            </div>
        </form>
    </main>

@endsection
