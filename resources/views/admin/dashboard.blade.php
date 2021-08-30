@extends('layout.app', ['title'=>'Tableau de bord'])

@section('content')
    <h1>Dashboard</h1>
    <x-admin-menu />
    <nav class="nav">
    </nav>

    @include('livewire.table')
@endsection

@section('styles')
    @livewireStyles
@endsection

@section('scripts')
    @livewireScripts
@endsection
