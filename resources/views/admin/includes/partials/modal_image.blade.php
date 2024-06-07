<!-- Modal Images -->
<form action="{{ route('admin.image.update') }}" data-bs-backdrop="static" method="post" id="quick_images-update-form" class="save-form">
    @csrf
    <div class="modal fade" id="image-modal" tabindex="-1" aria-labelledby="image-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="image-label">{{ __('Update meta image') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="card text-bg-light ratio ratio-1x1">
                                <img src="" class="card-img object-fit-contain" alt="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="image-name">{{ __('File name') }}</label>
                                <input type="text" class="form-control" name="name" id="image-name" placeholder="{{ __('Enter file name') }}">
                            </div>
                            <div class="form-group">
                                <label for="image-alt">{{ __('Alternate') }}</label>
                                <input type="text" class="form-control" name="alt" id="image-alt" placeholder="{{ __('Enter alternate description') }}">
                            </div>
                            <div class="form-group">
                                <label for="image-caption">{{ __('Description') }}</label>
                                <textarea class="form-control" name="caption" id="image-caption" rows="10" placeholder="{{ __('Enter image description') }}"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-end">
                    <input type="hidden" name="id" id="image-id">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END Images modals -->