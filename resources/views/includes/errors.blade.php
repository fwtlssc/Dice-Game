

@if ($errors->any())
<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li><p>{{ $error }}</p></li>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        @endforeach
    </ul>
</div>
@endif