@if(session()->has('success'))
    <div class="alert alert-custom alert-notice alert-light-success fade show mb-5" role="alert">
        <div class="alert-icon">
            <i class="far fa-check-circle text-success"></i>
        </div>
        <div class="alert-text">{{ session()->get('success') }}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    <i class="ki ki-close"></i>
                </span>
            </button>
        </div>
    </div>
@endif

@if(session()->has('error'))
    <div class="alert alert-custom alert-notice alert-light-danger fade show mb-5" role="alert">
        <div class="alert-icon">
            <i class="far fa-times-circle text-danger"></i>
        </div>
        <div class="alert-text">{{ session()->get('error') }}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    <i class="ki ki-close"></i>
                </span>
            </button>
        </div>
    </div>
@endif
