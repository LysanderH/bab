@extends('layout.app', ['title'=>'Se connecter'])

@section('content')
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
            <form class="" method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit"
                        class="btn btn-link p-0 m-0 align-baseline">{{ __('cliquer ici pour recevoir un nouveau.') }}</button>
            </form>
        </div>
    </div>
@endsection
