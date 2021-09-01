<div>
    @if (session()->has('message'))

        <div class="alert alert-success">

            {{ session('message') }}

        </div>

    @endif
    <table class="table">
        <thead class="table__head">
            <tr class="table__row">
                <th class="talbe__heading" scope="col">
                    <a href="" class="table__link">Nom</a>
                </th>
                <th class="talbe__heading" scope="col">
                    <a href="" class="table__link">Total</a>
                </th>
                <th class="talbe__heading" scope="col">
                    <a href="" class="table__link">Status</a>
                </th>
            </tr>
        </thead>
        <tbody class="table__body">
            @if (count($orders))
                @foreach ($orders as $order)
                    <tr class="table__row">
                        <td class="talbe__data">{{ $order->user->name }}</td>
                        <td class="talbe__data">@currency($order->total)</td>
                        <td class="talbe__data">
                            <form action="update/order" class="table__form form">
                                <input type="hidden" value="$order->id">
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
                    </tr>
                @endforeach
            @else
                <tr class="table__row">
                    <td class="talbe__data table__data--no-data" colspan="3">
                        Aucune commande n'a été faite
                    </td>
                </tr>
            @endif


        </tbody>
    </table>
</div>
