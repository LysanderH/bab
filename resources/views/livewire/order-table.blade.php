<div>
    @if (session()->has('message'))

        <div class="alert alert-success">

            {{ session('message') }}

        </div>

    @endif
    <div class="table__sort">
        <form class="search" method="GET">
            <input type="search" name="term" class="search__control form-control" wire:model="term"
                   placeholder="Rechercher">
            <noscript>
                <button role="button" type="submit">Rechercher</button>
            </noscript>
        </form>
        <form class="per-page" method="GET">
            <select name="perPage" class="per-page__control" wire:model="perPage">
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="75">75</option>
                <option value="100">100</option>
            </select>
            <noscript>
                <button role="button" type="submit">Afficher</button>
            </noscript>
        </form>
    </div>
    <div class="table__wrapper">
        <table class="table">
            <thead class="table__head">
                <tr class="table__row">
                    <th class="talbe__heading w-50">
                        &nbsp;
                    </th>
                    <th class="talbe__heading" scope="col">
                        Nom
                    </th>
                    <th class="talbe__heading" scope="col">
                        Total
                    </th>
                    <th class="talbe__heading" scope="col">
                        Status
                    </th>
                    <th class="talbe__heading" scope="col">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="table__body" wire:loading.class.delay="loading">
                @if (count($orders))
                    @foreach ($orders as $order)
                        <tr class="table__row">
                            <td class="talbe__data">{{ $loop->iteration }}</td>
                            <td class="talbe__data">{{ $order->user->name }}</td>
                            <td class="talbe__data">
                                @currency($order->total)
                            </td>
                            <td
                                class="talbe__data {{ transliterator_transliterate('Any-Latin; Latin-ASCII; Lower()', $order->status->name) }}">
                                <form action=" update/order" class="table__form form">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" value="{{ $order->id }}">
                                    <select name="status"
                                            wire:change="changeStatus({{ $order->id }}, $event.target.value)">
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}"
                                                    @if ($status->id === $order->status_id) selected @endif>{{ $status->name }}</option>
                                        @endforeach
                                    </select>
                                    <noscript>
                                        <button type="submit">Modifier</button>
                                    </noscript>
                                </form>
                            </td>
                            <td class="table__data table__data--action">
                                <div>
                                    <a href="{{ route('admin.order.show', ['order' => $order->id]) }}"
                                       class="table__link table__link--show">@include('icons.eye')<span
                                              class="sr-only">Voir
                                            la commande</span></a>
                                    <form action="{{ route('admin.order.destroy', ['order' => $order->id]) }}"
                                          method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="table__link table__link--delete">
                                            @include('icons.delete')<span
                                                  class="sr-only">Supprimer
                                                la commande</span></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="table__row">
                        <td class="talbe__data table__data--no-data" colspan="5">
                            Aucun livre existe
                        </td>
                    </tr>
                @endif

            </tbody>
        </table>
    </div>
    {{ $orders->links('vendor.pagination.default') }}
</div>
