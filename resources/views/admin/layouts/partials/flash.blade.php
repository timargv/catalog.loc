<div style="z-index: 999999;">
@if (session('status'))
    <div class="alert alert-success border-0 rounded-0">
        {{ session('status') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success border-0 rounded-0">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger border-0 rounded-0">
        {{ session('error') }}
    </div>
@endif

@if (session('info'))
    <div class="alert alert-info border-0 rounded-0">
        {{ session('info') }}
    </div>
@endif
</div>
