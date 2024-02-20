@if (session('success'))
    <div class="parent-div">
        <div class="alert alert-success text-center rounded-none">{{ session('success') }}</div>
    </div>
@endif