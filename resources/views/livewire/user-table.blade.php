<form class="search">
    <input type="search" class="search__control" wire:model="term" placeholder="Rechercher">
    <button role="button" type="submit">Rechercher</button>
</form>
<table class="table">
    <thead class="table__head">
        <tr class="table__row">
            <th class="talbe__heading" scope="col">
                &nbsp;
            </th>
            <th class="talbe__heading" scope="col">
                <a href="" class="table__link">Nom</a>
            </th>
            <th class="talbe__heading" scope="col">
                <a href="" class="table__link">Groupe</a>
            </th>
        </tr>
    </thead>
    <tbody class="table__body" wire:loading.class.delay="loading">
        @if (count($users))
            @foreach ($users as $u)
                <tr class="table__row">
                    <td class="talbe__data">
                        <img src="{{ asset('storage/avatars/small_' . $u->avatar) }}" alt="Foto de profil" width="50"
                             height="50">
                    </td>
                    <td class="talbe__data">{{ $u->name }}</td>
                    <td class="talbe__data">
                        {{ $u->group }}
                    </td>
                </tr>
            @endforeach
        @else
            <tr class="table__row">
                <td class="talbe__data table__data--no-data" colspan="3">
                    Aucun utilisateur existe
                </td>
            </tr>
        @endif
        {{ $users->links() }}

    </tbody>
</table>
