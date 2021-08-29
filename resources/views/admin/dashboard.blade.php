@extends('layout.app', ['title'=>'Tableau de bord'])

@section('content')
    <h1>Tableau de bord</h1>

    @include('livewire.table')
@endsection

@section('styles')
    @livewireStyles
@endsection

@section('scripts')
    @livewireScripts
@endsection
