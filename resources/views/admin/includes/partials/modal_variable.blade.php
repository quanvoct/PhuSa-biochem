<form class="save-form" id="variable-form" method="post">
    @csrf
    <div class="modal fade" id="variable-modal" data-bs-backdrop="static" aria-labelledby="variable-modal-label">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h1 class="modal-title text-white fs-5" id="variable-modal-label">Biến thể</h1>
                    <button class="btn-close text-white" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="sticky-top">
                                <label class="form-label select-image" for="variable-image">
                                    <img class="img-fluid rounded-4 object-fit-cover" src="{{ asset('admin/images/placeholder.webp') }}" alt="Ảnh đại diện">
                                </label>
                                <input class="hidden-image" id="variable-image" name="image" type="hidden">
                                <div class="d-grid">
                                    <button class="btn btn-outline-primary btn-remove-image d-none" type="button">Xoá</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <label class="form-label" for="variable-sub_sku">Mã biến thể</label>
                                <input class="form-control" id="variable-sub_sku" name="sub_sku" type="text" placeholder="Mã biến thể" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="variable-name">Tên biến thể</label>
                                <input class="form-control" id="variable-name" name="name" type="text" placeholder="Tên biến thể" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="variable-price">Giá</label>
                                <input class="form-control money" id="variable-price" name="price" type="text" placeholder="Giá bán" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="variable-price">Dài &times; Rộng &times; Cao &times; Cân nặng</label>
                                <div class="input-group">
                                    <input class="form-control" id="variable-length" name="length" type="text" placeholder="Chiều dài (cm)" autocomplete="off">
                                    <input class="form-control" id="variable-width" name="width" type="text" placeholder="Chiều rộng (cm)" autocomplete="off">
                                    <input class="form-control" id="variable-height" name="height" type="text" placeholder="Chiều cao (cm)" autocomplete="off">
                                    <input class="form-control" id="variable-weight" name="weight" type="text" placeholder="Cân nặng (kg)" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="variable-description">Mô tả</label>
                                <textarea class="form-control" id="variable-description" name="description" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input ms-0 ms-md-1 me-1 me-md-2" id="variable-status" name="status" type="checkbox" value="1" role="switch" checked>
                                <label class="form-check-label" for="variable-status">Hoạt động</label>
                            </div>
                        </div>
                        <div class="col-6 text-end">
                            @if (!empty(Auth::user()->hasAnyPermission(App\Models\User::UPDATE_VARIABLE, App\Models\User::CREATE_VARIABLE)))
                                <input name="id" type="hidden">
                                <input name="product_id" type="hidden">
                                <button class="btn btn-info px-3 fw-bold" type="submit">Lưu</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
