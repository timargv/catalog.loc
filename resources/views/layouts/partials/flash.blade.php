
@if (session('status'))
    <div style="padding: 20px 30px; z-index: 999999;">
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    </div>
@endif

@if (session('success'))
    <div style="padding: 20px 30px; z-index: 999999;">
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    </div>
@endif

@if (session('error'))
    <div style="padding: 20px 30px; z-index: 999999;">
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    </div>
@endif

@if (session('info'))
    <div style="padding: 20px 30px; z-index: 999999;">
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
    </div>
@endif
