<form class="save-form" id="catalogue-form" method="post">
    @csrf
    <div class="modal fade" id="catalogue-modal" data-bs-backdrop="static" aria-labelledby="catalogue-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h1 class="modal-title text-white fs-5" id="catalogue-modal-label">{{ __('Catalogue') }}</h1>
                    <button class="btn-close text-white" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="sticky-top">
                                <label class="form-label select-image" for="catalogue-image">
                                    <img class="img-fluid rounded-4 object-fit-cover" src="{{ asset('admin/images/placeholder.webp') }}" alt="{{ __('Featured image') }}">
                                </label>
                                <input class="hidden-image" id="catalogue-image" name="image" type="hidden">
                                <div class="d-grid">
                                    <button class="btn btn-outline-primary btn-remove-image d-none" type="button">{{ __('Remove') }}</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="catalogue-name">{{ __('Name') }}</label>
                                <input class="form-control" id="catalogue-name" name="name" type="text" placeholder="{{ __('Enter catalogue name') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="catalogue-parent_id">{{ __('Parent catalogue') }}</label>
                                <select class="form-control select2" id="catalogue-parent_id" name="parent_id" data-placeholder="{{ __('Choose parent catalogue') }}"></select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="catalogue-description">{{ __('Description') }}</label>
                                <textarea class="form-control" id="catalogue-description" name="description" rows="6" placeholder="{{ __('Enter catalogue description') }}"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr class="px-5">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" id="catalogue-status" name="status" type="checkbox" checked>
                                    <label class="form-check-label" for="catalogue-status">{{ __('Enabled') }}</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 text-end">
                                @if (!empty(Auth::user()->hasAnyPermission(App\Models\User::UPDATE_CATALOGUE, App\Models\User::CREATE_CATALOGUE)))
                                    <input name="id" type="hidden">
                                    <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
