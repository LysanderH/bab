<section class="user-orders" aria-label="Commandes">
    <h3 class="user-orders__heading" role="heading" aria-level="3">Commandes</h3>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <table class="table">
        <thead class="table__head">
            <tr class="table__row">
                <th class="talbe__heading" scope="col">
                    &nbsp;
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
            @if (count($user->orders))
                @foreach ($user->orders as $order)
                    <tr class="table__row">
                        <td class="talbe__data">{{ $loop->iteration }}</td>
                        <td class="talbe__data">@currency($order->total)</td>
                        <td class="talbe__data">
                            <form action="admin/update/order" class="table__form form">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{ $order->id }}">
                                <select name="status"
                                        wire:change="changeStatus({{ $order->id }}, $event.target.value)">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}"
                                                @if ($status->id === $order->status_id) selected @endif>{{ $status->name }}</option>
                                    @endforeach
                                    <noscript>
                                        <button type="submit">Modifier</button>
                                    </noscript>
                                </select>
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
</section>
