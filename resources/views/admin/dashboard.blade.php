@extends('layout.app', ['title'=>'Tableau de bord'])

@section('content')
    <h1>Tableau de bord</h1>
    <nav class="nav">
        <a href="{{ route('admin.book.create') }}" class="nav__link">Ajouter un livre</a>
    </nav>

    @include('livewire.table')
@endsection

@section('styles')
    @livewireStyles
@endsection

@section('scripts')
    @livewireScripts
@endsection
