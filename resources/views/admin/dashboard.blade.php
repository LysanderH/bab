@extends('layout.app', ['title'=>'Tableau de bord'])

@section('content')
    <h1>Dashboard</h1>
    <x-admin-menu />
    <nav class="controls" aria-label="Navigation de la ressource">
        <h2 class="controls__heading sr-only" role="heading" aria-level="2">Navigation du dashboard</h2>
        <div class="controls__wrapper">
            <a href="{{ route('admin.period.create') }}" class="controls__link">Commencer une nouvelle période</a>
        </div>
    </nav>

    <livewire:table />
@endsection

@section('styles')
    @livewireStyles
@endsection

@section('scripts')
    @livewireScripts
@endsection
