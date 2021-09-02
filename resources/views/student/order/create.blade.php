@extends('layout.app', ['title'=>'Commander'])

@section('content')
    <header class="header">
        <h1>Commander</h1>
        <x-user-menu />
    </header>
    <main>
        <form action="{{ route('student.order.add') }}" method="POST">
            @csrf
            @foreach ($bacs as $bac)
                <ul class="bac__list">
                    <li class="bac__item">
                        <p class="bac__name">{{ $bac->name }}</p>
                        @if (count($bac->books))
                            @foreach ($bac->books as $book)
                                <ul class="book-list">
                                    <li class="book-list__item">
                                        <input type="checkbox" name="book[]" value="{{ $book->id }}"
                                               id="book-{{ $book->id }}"
                                               {{ in_array($book->id, $selected) ? 'checked' : '' }}>
                                        <label for="book-{{ $book->id }}" class="book__label">
                                            <span class="book__heading" role="heading" aria-level="2">{{ $book->title }}
                                            </span>
                                            <img src="{{ asset('storage/covers/small_' . $book->cover) }}"
                                                 alt="Foto de profil"
                                                 width="250"
                                                 height="250">
                                            <span class="book__price">@currency($book->price)</span>
                                            <span class="book__description">{{ $book->exerpt }}</span>
                                        </label>
                                    </li>
                                </ul>
                            @endforeach
                        @else
                            <p>Pas de livres pour ce bac.</p>
                        @endif
                    </li>
                </ul>
            @endforeach
            <button type="submit">Continuer</button>
        </form>
    </main>

@endsection
