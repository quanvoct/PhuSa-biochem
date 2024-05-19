<form method="post" id="catalogue-form" class="save-form">
    @csrf
    <div class="card mb-3">
        <div class="modal fade" id="catalogue-modal" aria-labelledby="catalogue-modal-label"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="catalogue-modal-label">Danh mục</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="catalogue-name" class="form-label">Tên danh mục</label>
                            <input type="text" class="form-control" id="catalogue-name" name="name" placeholder="Tên danh mục">
                        </div>
                        <div class="mb-3">
                            <label for="catalogue-note" class="form-label">Ghi chú</label>
                            <textarea name="note" id="catalogue-note" class="form-control" placeholder="Nhập nội dung ghi chú"></textarea>
                        </div>
                        <hr class="px-5">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" name="status" checked id="catalogue-status">
                                        <label for="catalogue-status" class="form-check-label">Hoạt động</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 text-end">
                                    @if (!empty(Auth::user()->hasAnyPermission(App\Models\User::UPDATE_CATALOGUE,App\Models\User::CREATE_CATALOGUE)))
                                    <input type="hidden" name="id">
                                    <button type="submit" class="btn btn-primary">Lưu</button>
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
