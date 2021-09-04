@extends('layout.app', ['title'=>'Tableau de bord'])

@section('content')
    <header class="header">
        <div class="header__wrapper">
            <h1 class="header__heading"><a href="{{ route('admin.dashboard') }}" class="header__link">Book a Book</a>
                <span class="sr-only">- Dashboard</span>
            </h1>
            <x-admin-menu />
        </div>
    </header>
    <main>
        @include('layout.success')
        @include('layout.error')
        <nav class="controls" aria-label="Navigation de la ressource">
            <h2 class="sr-only controls__heading" role="heading" aria-level="2">Navigation du dashboard</h2>
            <div class="controls__wrapper">
                <a href="{{ route('admin.period.create') }}" class="controls__link">@include('icons.restart') Commencer une
                    nouvelle période</a>
                <a href="{{ route('admin.export') }}" class="controls__link">@include('icons.export') Exporter</a>
            </div>
        </nav>

        <livewire:table />
    </main>
@endsection

@section('styles')
    @livewireStyles
@endsection

@section('scripts')
    @livewireScripts
@endsection
