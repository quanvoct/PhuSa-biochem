<form class="save-form" id="category-form" method="post">
    @csrf
    <div class="modal fade" id="category-modal" data-bs-backdrop="static" aria-labelledby="category-modal-label">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h1 class="modal-title text-white fs-5" id="category-modal-label">{{ __('Category') }}</h1>
                    <button class="btn-close text-white" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="category-name">{{ __('Name') }}</label>
                        <input class="form-control" id="category-name" name="name" type="text" placeholder="{{ __('Enter category name') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="category-note">{{ __('Note') }}</label>
                        <textarea class="form-control" id="category-note" name="note" rows="6" placeholder="{{ __('Note about this category') }}"></textarea>
                    </div>
                    <hr class="px-5">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" id="category-status" name="status" type="checkbox" checked>
                                    <label class="form-check-label" for="category-status">{{ __('Enabled') }}</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 text-end">
                                @if (!empty(Auth::user()->hasAnyPermission(App\Models\User::UPDATE_CATEGORY, App\Models\User::CREATE_CATEGORY)))
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
