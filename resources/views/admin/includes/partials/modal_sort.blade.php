<!-- Modal sort -->
<div class="modal fade" id="sort-modal" aria-labelledby="sort-label">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="sort-label">{{ __('List sorting') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <h6 class="text-secondary">{{ __('Sort type') }}</h6>
                        <select name="type" id="sort-type" class="form-select">
                            <option hidden selected disabled>{{ __('Choose a sort type') }}</option>
                            <option value="time-az">{{ __('Created at') }} ({{ __('oldest first') }})</option>
                            <option value="time-za">{{ __('Created at') }} ({{ __('newest first') }})</option>
                            <option value="title-az">{{ __('Title') }} (A-Z)</option>
                            <option value="title-za">{{ __('Title') }} (Z-A)</option>                            
                        </select>
                        <hr class="px-5 mt-3">
                        <ul id="sortable" class="list-group mb-3">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>