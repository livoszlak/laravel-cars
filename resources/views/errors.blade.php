<div>
    @if ($errors->any())
    <div class="error-container">
        @foreach ($errors->all() as $error)
            <p class="error">    
            {{ $error }}
            </p>
        @endforeach
    @endif
</div>