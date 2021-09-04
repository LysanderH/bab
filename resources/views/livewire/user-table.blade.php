<div>
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
                <button role="button" type="submit">Changer</button>
            </noscript>
        </form>
    </div>
    <div class="table__wrapper">
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
                        <a href="?sortBy=name"
                           class="table__link"
                           wire:click.prevent="sortBy('name')">Nom</a>
                    </th>
                    <th class="talbe__heading" scope="col">
                        <a href="?sortBy=group" class="table__link" wire:click.prevent="sortBy('group')">Groupe</a>
                    </th>
                    <th class="talbe__heading" scope="col">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="table__body" wire:loading.class.delay="loading">
                @if (count($users))
                    @foreach ($users as $u)
                        <tr class="table__row">
                            <td class="talbe__data">{{ $loop->iteration }}</td>
                            <td class="talbe__data">
                                <img src="{{ asset('storage/avatars/small_' . $u->avatar) }}" alt="Foto de profil"
                                     width="50"
                                     height="50"
                                     class="profile">
                            </td>
                            <td class="talbe__data">{{ $u->name }}</td>
                            <td class="talbe__data">
                                {{ $u->group }}
                            </td>
                            <td class="table__data table__data--action">
                                <div>
                                    <a href="{{ route('admin.user.show', ['user' => $u->id]) }}"
                                       class="table__link table__link--show">@include('icons.eye')<span
                                              class="sr-only">Voir
                                            l’utilisateur</span></a>
                                    <form action="{{ route('admin.user.destroy', ['user' => $u->id]) }}"
                                          method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="table__link table__link--delete">
                                            @include('icons.delete')
                                            <span class="sr-only">Supprimer
                                                l’utilisateur</span></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="table__row">
                        <td class="talbe__data table__data--no-data" colspan="5">
                            Aucun utilisateur existe
                        </td>
                    </tr>
                @endif

            </tbody>
        </table>
    </div>
    {{ $users->links() }}
</div>
