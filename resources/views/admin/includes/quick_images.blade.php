<!-- Quick Images -->
<div class="card mb-0">
    <div class="card-header">
        @if (!empty(Auth::user()->can(App\Models\User::CREATE_IMAGE)))
            <a class="btn btn-primary btn-upload-images cursor-pointer" type="button">
                <i class="bi bi-cloud-upload-fill"></i> {{ __('Upload') }}
            </a>
        @endif
        @if (!empty(Auth::user()->can(App\Models\User::DELETE_IMAGES)))
            <a class="btn btn-danger btn-delete-images ms-2 d-none" type="button">
                <i class="bi bi-trash"></i> {{ __('Remove') }}
            </a>
        @endif
    </div>
    <div class="card-body">
        @if (!empty(Auth::user()->can(App\Models\User::CREATE_IMAGE)))
            <div id="quick_images-dropzone" onclick="selectFile(this)">
                <i class="bi bi-cloud-upload"></i>
                <input id="quick_images-input" name="images[]" type="file" onchange="validateImagesSize(this)" multiple accept="image/*">
                <div id="upload-progress d-none">
                    <div id="progress-text">0%</div>
                </div>
            </div>
        @endif
        @if (!empty(Auth::user()->can(App\Models\User::READ_IMAGES)))
            <form id="quick_images-form" method="post">
                @csrf
                <table class="display" id="quick_images-table" style="display: none;" cellspacing="0" width="100%"></table>
                <div class="row quick_images-grid-view" id="quick_images-grid-view"></div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary btn-insert-images d-none" type="button">{{ __('Add') }}</button>
                    <button class="btn btn-primary btn-select-images d-none" type="button">{{ __('Select') }}</button>
                </div>
            </form>
        @else
            @include('admin.includes.access_denied')
        @endif
    </div>
</div>
<!-- END Quick Images -->
