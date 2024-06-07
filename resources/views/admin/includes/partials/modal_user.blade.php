<form class="save-form" id="user-form" method="post">
    @csrf
    <div class="card mb-3">
        <div class="modal fade" id="user-modal" aria-labelledby="user-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="user-modal-label">{{ __('Users') }}</h1>
                        <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="sticky-top">
                                    <div class="form-group mb-3">
                                        <label class="form-label ratio ratio-1x1" for="user-image">
                                            <img class="img-fluid rounded-4 object-fit-cover" id="user-image-preview" src="{{ asset('admin/images/placeholder.webp') }}" alt="{{ __('Featured image') }}">
                                        </label>
                                        <input class="form-control" id="user-image" name="image" type="file" hidden accept="image/*">
                                        <div class="d-grid">
                                            <button class="btn btn-outline-primary btn-remove-image d-none" type="button">{{ __('Remove') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="form-group mb-3">
                                    <label for="user-name">{{ __('Display name') }}</label>
                                    <input class="form-control" id="user-name" name="name" type="text" placeholder="{{ __('Display name') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="user-gender">{{ __('Gender') }}</label>
                                    <select class="form-select" id="user-gender" name="gender">
                                        <option value="1">{{ __('Male') }}</option>
                                        <option value="0">{{ __('Female') }}</option>
                                        <option value="2">{{ __('Undisclosed') }}</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="user-birthday">{{ __('Birthday') }}</label>
                                    <input class="form-control" id="user-birthday" name="birthday" type="date" max="{{ date('Y-m-d') }}" inputmode="number">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="user-email">{{ __('Email') }}</label>
                                    <input class="form-control" id="user-email" name="email" type="email" placeholder="{{ __('Use for login') }}" inputmode="email">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="user-phone">{{ __('Phone') }}</label>
                                    <input class="form-control" id="user-phone" name="phone" type="text" placeholder="{{ __('Contact phone') }}" inputmode="numeric">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="user-address">{{ __('Address') }}</label>
                                    <input class="form-control" id="user-address" name="address" type="text" placeholder="{{  __('Room number, floor number, building, address, street, district')}}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="user-address">{{ __('Locale') }}</label>
                                    <div class="row">
                                        <div class="col-12 col-md-4 pe-0">
                                            <select class="form-select select2" id="user-country" name="country" data-placeholder="{{ __('Choose country') }}"></select>
                                        </div>
                                        <div class="col-12 col-md-4 pe-0">
                                            <select class="form-select select2" id="user-city" name="city" data-placeholder="{{ __('Choose city') }}"></select>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <input class="form-control" id="user-zip" name="zip" type="text" placeholder="{{ __('Zip Portal Code') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="px-5">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" id="user-status" name="status" type="checkbox" checked>
                                        <label class="form-check-label" for="user-status">{{ __('Enabled') }}</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 text-end">
                                    @if (!empty(Auth::user()->hasAnyPermission(App\Models\User::UPDATE_USER, App\Models\User::CREATE_USER)))
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
    </div>
</form>
<form class="save-form" id="user_role-form" method="post">
    @csrf
    <div class="card mb-3">
        <div class="modal fade" id="user_role-modal" aria-labelledby="user_role-modal-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="user_role-modal-label">Thiết lập vai trò</h1>
                        <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-label" for="user_role-role_id">Vai trò</label>
                            <select class="form-select" id="user_role-role_id" name="role_id" required autocomplete="off" multiple>
                                <option selected hidden disabled>Chọn một vai trò</option>
                                @foreach (Spatie\Permission\Models\Role::get() as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr class="px-5">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                </div>
                                <div class="col-12 col-lg-6 text-end">
                                    @if (!empty(Auth::user()->hasAnyPermission(App\Models\User::UPDATE_USER)))
                                        <input name="id" type="hidden">
                                        <button class="btn btn-primary" type="submit">Lưu</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<form class="save-form" id="user_password-form" method="post">
    @csrf
    <div class="card mb-3">
        <div class="modal fade" id="user_password-modal" aria-labelledby="user_password-modal-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="user_password-modal-label">Đặt mật khẩu</h1>
                        <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-label" for="user_password-role_id">Mật khẩu mới</label>
                            <input class="form-control" id="user_password-password" name="password" type="text">
                        </div>
                        <hr class="px-5">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                </div>
                                <div class="col-12 col-lg-6 text-end">
                                    @if (!empty(Auth::user()->hasAnyPermission(App\Models\User::UPDATE_USER)))
                                        <input name="id" type="hidden">
                                        <button class="btn btn-primary" type="submit">Lưu</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
