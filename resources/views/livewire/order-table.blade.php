<div>
    @if (session()->has('message'))

        <div class="alert alert-success">

            {{ session('message') }}

        </div>

    @endif
    <form class="search" method="GET">
        <input type="search" name="term" class="search__control" wire:model="term" placeholder="Rechercher">
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
        <button role="button" type="submit">Rechercher</button>
    </form>
    <table class="table">
        <thead class="table__head">
            <tr class="table__row">
                <th class="talbe__heading" scope="col">
                    &nbsp;
                </th>
                <th class="talbe__heading" scope="col">
                    Nom
                </th>
                <th class="talbe__heading" scope="col">
                    <a href="?sortBy=total"
                       class="table__link"
                       wire:click.prevent="sortBy('total')">Total</a>
                </th>
                <th class="talbe__heading" scope="col">
                    <a href="?sortBy=status"
                       class="table__link"
                       wire:click.prevent="sortBy('status')">Status</a>
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
                        <td class="talbe__data">{{ $order->name }}</td>
                        <td class="talbe__data">
                            {{ $order->total }}
                        </td>
                        <td class="talbe__data">
                            <form action="update/order" class="table__form form">
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
                        <td class="talbe__data talbe__data--action">
                            <a href="{{ route('admin.order.show', ['order' => $order->id]) }}"
                               class="table__link table__link--show"><span
                                      class="sr-only">Voir
                                    le livre</span></a>
                            <form action="{{ route('admin.order.destroy', ['order' => $order->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="table__link table__link--delete"><span
                                          class="sr-only">Supprimer
                                        le livre</span></button>
                            </form>
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
            {{ $orders->links() }}

        </tbody>
    </table>
</div>
