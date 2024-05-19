<form class="save-form" id="product-form" method="post">
    @csrf
    <div class="card mb-3">
        <div class="modal fade" id="product-modal" aria-labelledby="product-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="product-modal-label">Thông tin sản phẩm</h1>
                        <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="form-group sticky-top">
                                    <div class="mb-3">
                                        <label for="product-sku">Mã sản phẩm</label>
                                        <input class="form-control" id="product-sku" name="sku" type="text" placeholder="Mã sản phẩm" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="product-name">Tên sản phẩm</label>
                                        <input class="form-control" id="product-name" name="name" type="text" placeholder="Tên sản phẩm" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="product-name">Danh mục</label>
                                        <select class="form-select" id="product-catalogue_id" name="catalogue_id[]" data-placeholder="Chọn một danh mục" size="1" required autocomplete="off" multiple>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="product-note">Mô tả sản phẩm</label>
                                        <textarea class="form-control" id="product-note" name="note" placeholder="Mô tả sản phẩm"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-8">
                                <div class="row">
                                    <div class="col-6">
                                        <p class="text-secondary">Các biến thể</p>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="btn btn-outline-primary btn-sm btn-create-variable">
                                            <i class="bi bi-plus-circle"></i> Thêm biến thể
                                        </button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-borderless table-detail">
                                        <thead>
                                            <tr>
                                                <th style="width: 12%">Mã</th>
                                                <th style="width: 30%">Tên</th>
                                                <th>Đơn vị</th>
                                                <th style="width: 40%">Xuất xứ</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="product-variables">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr class="px-5">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" id="product-status" name="status" type="checkbox" value="1" checked>
                                        <label class="form-check-label" for="product-status">Hoạt động</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 text-end">
                                    @if (!empty(Auth::user()->hasAnyPermission(App\Models\User::UPDATE_PRODUCT, App\Models\User::CREATE_PRODUCT)))
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
