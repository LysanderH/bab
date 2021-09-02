@extends('layout.app', ['title'=>'Se connecter'])

@section('content')
    <header class="header">
        <div class="header__wrapper">
            <h1 class="header__heading">Book a Book <span class="sr-only">- Se connecter</span></h1>
        </div>
    </header>
    <div class="card">
        <div class="card-header">{{ __('Verify Your Email Address') }}</div>

        <div class="card-body">
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('Un lien de vérification vous a été envoyé par email.') }}
                </div>
            @endif

            {{ __('Avant de continuer veuillez vérifier votre boite mail pour le lien de vérification.') }}
            {{ __('Si vous n’avez pas reçus de mail') }},
            <form class="___class_+?8___" method="POST" action="{{ route('verification.send') }}" class="form">
                @csrf
                <button type="submit"
                        class="btn btn-link p-0 m-0 align-baseline">{{ __('cliquer ici pour recevoir un nouveau.') }}</button>
            </form>
        </div>
    </div>
@endsection
