@extends('layout.app', ['title'=>'Liste des commandes'])

@section('content')
    <h1>Liste des commandes</h1>
    <x-admin-menu />

    <section class="controls" aria-label="Navigation de la ressource">
        <h2 class="controls__heading sr-only" role="heading" aria-level="2">Navigation de la ressource</h2>
        <div class="controls__wrapper">
            <a href="{{ route('admin.order.create') }}" class="controls__link">Ajouter une commande</a>
        </div>
    </section>

    <livewire:order-table />
@endsection
@section('styles')
    @livewireStyles
@endsection

@section('scripts')
    @livewireScripts
@endsection
