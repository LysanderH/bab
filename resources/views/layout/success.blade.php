@if (session('success'))
    <div class="alert alert-success">
        <p class="alert__text">{{ session('success') }}</p>
    </div>
@endif
