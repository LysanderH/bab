@if (session('error'))
    <div class="alert alert-error">
        <p class="alert__text">{{ session('error') }}</p>
    </div>
@endif
