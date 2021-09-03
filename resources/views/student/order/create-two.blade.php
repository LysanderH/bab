@extends('layout.app', ['title'=>'Commander'])

@section('content')
    <header class="header">
        <div class="header__wrapper">
            <h1 class="header__heading">Book a Book <span class="sr-only">- Commander partie 2</span>
            </h1>
            <x-user-menu />
        </div>
    </header>
    <main>
        <form action="{{ route('student.order.store') }}" method="POST">
            @csrf

            <table class="table">
                <thead class="table__head">
                    <tr class="table__row">
                        <th class="talbe__heading" scope="col">
                            &nbsp;
                        </th>
                        <th class="talbe__heading" scope="col">
                            &nbsp;
                        </th>
                        <th class="talbe__heading" scope="col">
                            Titre
                        </th>
                        <th class="talbe__heading" scope="col">
                            Prix unitaire
                        </th>
                        <th class="talbe__heading" scope="col">
                            Exemplaires
                        </th>
                        <th class="talbe__heading" scope="col">
                            Prix
                        </th>
                    </tr>
                </thead>
                <tbody class="table__body">
                    @if (count($books))
                        @foreach ($books as $book)
                            <tr class="table__row">
                                <td class="talbe__data">{{ $loop->iteration }}</td>
                                <td class="talbe__data">
                                    <img src="{{ asset('storage/covers/small_' . $book->cover) }}" alt="Foto de profil"
                                         width="250"
                                         height="250">
                                </td>
                                <td class="talbe__data">{{ $book->title }}</td>
                                <td class="talbe__data">
                                    @currency($book->price)
                                </td>
                                <td class="talbe__data talbe__data--action">
                                    <div class="form-group">
                                        <label for="amount{{ $book->id }}"
                                               class="form-label">{{ __('Examplaires') }}</label>

                                        <input id="amount{{ $book->id }}" type="number"
                                               class="form-control amount-input @error('amount') is-invalid @enderror"
                                               name="amount[{{ $book->id }}]"
                                               value="{{ $amount ?? (old('amount') ?? 1) }}" required
                                               placeholder="0" min="0" data-price="{{ $book->price }}"
                                               data-id="{{ $book->id }}">

                                        @error('title')
                                            <p class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </td>
                                <td class="talbe__data" id="price-{{ $book->id }}">
                                    @currency($book->price)
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr class="table__row">
                            <td class="talbe__data table__data--no-data" colspan="7">
                                Aucun livre ajouté
                            </td>
                        </tr>
                    @endif

                </tbody>
                <tfoot>
                    <tr class="table__row">
                        <th class="talbe__data table__data--no-data" colspan="5">
                            Total
                        </th>
                        <td class="talbe__data table__data--no-data" colspan="1" id="total">
                            @currency($total ?? 0)
                        </td>
                    </tr>
                </tfoot>
            </table>

            <div class="form-group">
                <button type="submit" class="btn btn-submit">
                    {{ __('Enregistrer la commande') }}
                </button>
            </div>
        </form>
    </main>

@endsection

@section('scripts')
    <script>
        const amountFields = document.querySelectorAll('.amount-input');
        const totalNode = document.querySelector('#total');

        function calculateTotal() {
            let total = 0;
            amountFields.forEach(function(field) {
                total = total + (field.dataset.price * field.value);
                totalNode.innerHTML = new Intl.NumberFormat('fr-FR', {
                    style: 'currency',
                    currency: 'EUR',
                }).format(total);
            });
        }

        function calculateBookTotal(e) {
            let bookTotal = 0;
            const bookTotalNode = document.querySelector('#price-' + e.target.dataset.id);
            bookTotal = bookTotal + (e.target.dataset.price * e.target.value);
            bookTotalNode.innerHTML = new Intl.NumberFormat('fr-FR', {
                style: 'currency',
                currency: 'EUR',
            }).format(bookTotal);
        }

        amountFields.forEach(function(field) {
            field.addEventListener('change', function(e) {
                calculateBookTotal(e);
                return calculateTotal();
            })
        });
    </script>
@endsection
