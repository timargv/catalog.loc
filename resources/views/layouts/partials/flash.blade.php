
    <!-- Position it -->
    <div style="position: absolute; top: 15px; right: 15px; z-index: 9">
@if (session('warning'))
    <!-- Then put toasts within -->
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000">
            @if(session('warning_title'))
                <div class="toast-header">
                    <i class="fas fa-circle mr-2 text-warning"></i>
                    <strong class="mr-auto pr-3">{{ session('warning') }}</strong>
                    <small class="text-muted">только что</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @else
                <div class="toast-body border border-warning bg-warning text-dark">
                    {{ session('warning') }}
                </div>
            @endif
 
            @if(session('warning_title'))
                <div class="toast-body">
                    <div class="row">
                        <div class="col-2 pr-0"><img src="{{ session('warning_img') == null ? Storage::disk('public')->url('image/no_photo.jpg') : Storage::disk('public')->url('products/medium/'.  session('warning_img')) }}" alt="" class=" img-circle  mr-0 pr-0 w-100" ></div>
                        <div class="col-10">{{ session('warning_title') }}</div>
                    </div>
                </div>
            @endif
        </div>
@endif

@if (session('success'))
    <!-- Then put toasts within -->
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000">
            @if(session('success_title'))
                <div class="toast-header">
                    <i class="fas fa-circle mr-2 text-success"></i>
                    <strong class="mr-auto pr-3">{{ session('success') }}</strong>
                    <small class="text-muted">только что</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @else
                <div class="toast-body border border-success bg-success text-white">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('success_title'))
                <div class="toast-body">
                    <div class="row">
                        <div class="col-2 pr-0"><img src="{{ session('success_img') == null ? Storage::disk('public')->url('image/no_photo.jpg') : Storage::disk('public')->url('products/medium/'.  session('success_img')) }}"
                             alt="" class=" img-circle  mr-0 pr-0 w-100" ></div>
                        <div class="col-10">{{ session('success_title') }}</div>
                    </div>
                </div>
            @endif
        </div>

@endif

@if (session('error'))
    <!-- Then put toasts within -->
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000">
            @if(session('error_title'))
                <div class="toast-header">
                    <i class="fas fa-circle mr-2 text-danger"></i>
                    <strong class="mr-auto pr-3">{{ session('error') }}</strong>
                    <small class="text-muted">только что</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @else
                <div class="toast-body border border-danger bg-danger text-white">
                    {{ session('error') }}
                </div>
            @endif
            @if(session('error_title'))
                <div class="toast-body">
                    <div class="row">
                        <div class="col-2 pr-0"><img @if(session('error_img')) src="{{ Storage::disk('public')->url('products/medium/'. session('error_img')) }}" @else src=" {{ Storage::disk('public')->url('image/no_photo.jpg') }} " @endif alt="" class=" img-circle  mr-0 pr-0 w-100" ></div>
                        <div class="col-10">{{ session('error_title') }}</div>
                    </div>
                </div>
            @endif
        </div>
@endif

@if (session('info'))
    <!-- Then put toasts within -->
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000">
            @if(session('info_title'))
                <div class="toast-header">
                    <i class="fas fa-circle mr-2 text-success"></i>
                    <strong class="mr-auto pr-3">{{ session('info') }}</strong>
                    <small class="text-muted">только что</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @else
                <div class="toast-body border border-info bg-info text-white">
                    {{ session('info') }}
                </div>
            @endif
            @if(session('info_title'))
                <div class="toast-body">
                    <div class="row">
                        <div class="col-2 pr-0"><img @if(session('info_img')) src="{{ Storage::disk('public')->url('products/medium/'. session('error_img')) }}" @else src="{{ Storage::disk('public')->url('image/no_photo.jpg') }}" @endif alt="" class=" img-circle  mr-0 pr-0 w-100" ></div>
                        <div class="col-10">{{ session('info_title') }}</div>
                    </div>
                </div>
            @endif
        </div>

    @endif


</div>

