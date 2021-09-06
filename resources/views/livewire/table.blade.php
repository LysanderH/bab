<div>
    @if (session()->has('message'))

        <div class="alert alert-success">

            {{ session('message') }}

        </div>

    @endif
    <div class="table__wrapper">
        <table class="table">
            <thead class="table__head">
                <tr class="table__row">
                    <th class="talbe__heading w-50" scope="col">
                        &nbsp;
                    </th>
                    <th class="talbe__heading" scope="col">
                        Nom étudiant
                    </th>
                    <th class="talbe__heading" scope="col">
                        Total
                    </th>
                    <th class="talbe__heading" scope="col">
                        Status
                    </th>
                </tr>
            </thead>
            <tbody class="table__body">
                @if (count($orders))
                    @foreach ($orders as $order)
                        <tr class="table__row">
                            <td class="talbe__data">{{ $loop->iteration }}</td>
                            <td class="talbe__data">{{ $order->user->name }}</td>
                            <td class="talbe__data">@currency($order->total)</td>
                            <td
                                class="talbe__data talbe__data--status {{ transliterator_transliterate('Any-Latin; Latin-ASCII; Lower()', $order->status->name) }}">
                                <form action="update/order" class="table__form">
                                    <input type="hidden" value="$order->id">
                                    <select name="status"
                                            wire:change="changeStatus({{ $order->id }}, $event.target.value)"
                                            class="select">
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
                        </tr>
                    @endforeach
                @else
                    <tr class="table__row">
                        <td class="talbe__data table__data--no-data" colspan="4">
                            Aucune commande n'a été faite
                        </td>
                    </tr>
                @endif


            </tbody>
        </table>
    </div>
    @if (count($orders))
        {{ $orders->links() }}
    @endif
</div>
