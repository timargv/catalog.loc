
    <!-- Position it -->
    <div style="position: absolute; top: 15px; right: 15px; z-index: 9">
@if (session('status'))
    <div style="padding: 20px 30px; z-index: 999999;">
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    </div>
@endif

@if (session('success'))
    <!-- Then put toasts within -->
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
            <div class="toast-header">
                <i class="fas fa-circle mr-2 text-success"></i>
                <strong class="mr-auto pr-3">{{ session('success') }}</strong>
                <small class="text-muted">только что</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                <div class="row">
                    <div class="col-2 pr-0"><img src="storage/products/medium/{{ session('success_img') }}" alt="" class=" img-circle  mr-0 pr-0 w-100" ></div>
                    <div class="col-10">{{ session('success_title') }}</div>
                </div>
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





    </div>

