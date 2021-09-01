<div>
    <form class="search" method="GET">
        <input type="search" name="term" class="search__control" wire:model="term" placeholder="Rechercher">
        <button role="button" type="submit">Rechercher</button>
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
                    &nbsp;
                </th>
                <th class="talbe__heading" scope="col">
                    <a href="?sortBy=title"
                       class="table__link"
                       wire:click.prevent="sortBy('title')">Titre</a>
                </th>
                <th class="talbe__heading" scope="col">
                    <a href="?sortBy=author" class="table__link" wire:click.prevent="sortBy('author')">Auteur</a>
                </th>
                <th class="talbe__heading" scope="col">
                    Stock
                </th>
                <th class="talbe__heading" scope="col">
                    Prix
                </th>
                <th class="talbe__heading" scope="col">
                    ISBN
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
                        <td class="talbe__data">
                            <img src="{{ asset('storage/covers/small_' . $order->cover) }}" alt="Foto de profil"
                                 width="250"
                                 height="250">
                        </td>
                        <td class="talbe__data">{{ $order->title }}</td>
                        <td class="talbe__data">
                            {{ $order->author }}
                        </td>
                        <td class="talbe__data">
                            {{ $order->stock }}
                        </td>
                        <td class="talbe__data">
                            @currency($order->total)
                        </td>

                        {{-- <td class="talbe__data">
                            {{ $sum_ordered }}
                        </td> --}}
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
                    <td class="talbe__data table__data--no-data" colspan="3">
                        Aucun livre existe
                    </td>
                </tr>
            @endif
            {{ $orders->links() }}

        </tbody>
    </table>
</div>