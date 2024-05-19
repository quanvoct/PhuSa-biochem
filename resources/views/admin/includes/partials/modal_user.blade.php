<form class="save-form" id="user-form" method="post">
    @csrf
    <div class="card mb-3">
        <div class="modal fade" id="user-modal" aria-labelledby="user-modal-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="user-modal-label">Tài khoản</h1>
                        <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="user-name">Tên đầy đủ</label>
                            <input class="form-control" id="user-name" name="name" type="text" placeholder="Vui lòng nhập tên đầy đủ">
                        </div>
                        <div class="form-group mb-3">
                            <label for="user-phone">Số điện thoại</label>
                            <input class="form-control" id="user-phone" name="phone" type="text" placeholder="Vui lòng nhập số điện thoại" inputmode="numeric">
                        </div>
                        <div class="form-group mb-3">
                            <label for="user-address">Địa chỉ</label>
                            <input class="form-control" id="user-address" name="address" type="text" placeholder="Vui lòng nhập địa chỉ">
                        </div>
                        <div class="form-group mb-3">
                            <label for="user-email">Email</label>
                            <input class="form-control" id="user-email" name="email" type="email" placeholder="Vui lòng nhập email">
                        </div>
                        <div class="form-group mb-3">
                            <label for="user-password">Đặt mật khẩu</label>
                            <input class="form-control" id="user-password" name="password" type="password" placeholder="Đặt mật khẩu.">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="user-role_id">Vai trò</label>
                            <select class="form-select" id="user-role_id" name="role_id" required autocomplete="off">
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
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" id="user-status" name="status" type="checkbox" checked>
                                        <label class="form-check-label" for="user-status">Hoạt động</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 text-end">
                                    @if (!empty(Auth::user()->hasAnyPermission(App\Models\User::UPDATE_USER, App\Models\User::CREATE_USER)))
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
