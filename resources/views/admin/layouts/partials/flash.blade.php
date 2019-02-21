<div class="position-relative">
        <div class="w-100 position-absolute" style="z-index: 999999;">
                @if (session('status'))
                        <div class="alert alert-success border-0 rounded-0 alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{ session('status') }}
                        </div>
                @endif

                @if (session('success'))
                        <div class="alert alert-success border-0 rounded-0 alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{ session('success') }}
                        </div>
                @endif

                @if (session('error'))
                        <div class="alert alert-danger border-0 rounded-0 alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{ session('error') }}
                        </div>
                @endif

                @if (session('info'))
                        <div class="alert alert-info border-0 rounded-0 alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{ session('info') }}
                        </div>
                @endif


        </div>

</div>