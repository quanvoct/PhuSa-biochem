<form class="save-form" id="order-form" name="order" method="post">
    @csrf
    <div class="modal fade" id="order-modal" aria-labelledby="order-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="order-modal-label">Đơn hàng</h1>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body border mb-3 rounded-3">
                        <legend>Thông tin đơn hàng</legend>
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="order-customer_id">Khách hàng</label>
                                    <select class="form-select select2" id="order-customer_id" name="customer_id" data-placeholder="Chọn một khách hàng">
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <label for="order-dealer">Người bán</label>
                                            <select class="form-select" id="order-dealer" name="dealer_id">
                                                <option selected disabled hidden>Chọn người bán</option>
                                                @foreach (app\Models\User::permission(app\Models\User::CREATE_ORDER)->get() as $index => $dealer)
                                                    <option value="{{ $dealer->id }}" {{ $dealer->id == Auth::user()->id ? 'selected' : '' }}>{{ $dealer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="order-dealer">Ngày bán</label>
                                            <input class="form-control" id="order-created_at" name="created_at" type="date" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" inputmode="numeric">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-5">
                                    <div class="d-grid gap-2">
                                        <div class="btn-group" role="group">
                                            <input class="btn-check" id="order-status-waiting" name="status" type="radio" value="1">
                                            <label class="btn btn-outline-primary" for="order-status-waiting">Mới đặt</label>
                                            <input class="btn-check" id="order-status-processing" name="status" type="radio" value="2">
                                            <label class="btn btn-outline-info" for="order-status-processing">Đang xử lý</label>
                                            <input class="btn-check" id="order-status-done" name="status" type="radio" value="3">
                                            <label class="btn btn-outline-success" for="order-status-done">Hoàn thành</label>
                                            <input class="btn-check" id="order-status-cancel" name="status" type="radio" value="0">
                                            <label class="btn btn-outline-danger" for="order-status-cancel">Bị hủy</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="order-discount">Giảm giá</label>
                                    <div class="input-group">
                                        <input class="form-control money order-discount" id="order-discount" name="discount" type="text" value="0" onclick="this.select()" placeholder="Vui lòng nhập giảm giá" inputmode="numeric">
                                        <span class="input-group-text">VND</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="order-note">Ghi chú</label>
                                    <textarea class="form-control" id="order-note" name="note" rows="5" placeholder="Nhập ghi chú nếu có"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border mb-3 rounded-3">
                        <div class="row">
                            <div class="col-12 col-lg-3 mb-2">
                                <legend>Chi tiết đơn hàng</legend>
                            </div>
                            <div class="col-12 col-lg-7 mb-2 d-flex justify-content-end">
                                <select class="form-select" name="order_stock" data-placeholder="Chọn một sản phẩm" type="text">
                                </select>
                            </div>
                            <div class="col-12 col-lg-2 mb-2 text-end">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-outline-primary btn-create-detail">
                                        <i class="bi bi-plus-circle"></i> Thêm
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless table-detail">
                                <thead>
                                    <tr>
                                        <th style="width: 50%">Sản phẩm</th>
                                        <th style="width: 12%">SL</th>
                                        <th>Đơn giá</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody id="order-details"></tbody>
                                <tfoot>
                                    <tr class="d-none">
                                        <th class="text-end" colspan="3">Thành tiền</th>
                                        <th>
                                            <input class="form-control text-end order-detail_summary bg-white" type="text" value="0" readonly />
                                        </th>
                                    </tr>
                                    <tr class="d-none">
                                        <th class="text-end" colspan="3">Giảm giá</th>
                                        <th>
                                            <input class="form-control text-end order-detail_discount bg-white" type="text" value="0" readonly />
                                        </th>
                                    </tr>
                                    <tr class="d-none">
                                        <th class="text-end" colspan="3">Còn lại</th>
                                        <th>
                                            <input class="form-control text-end order-detail_remain bg-white" type="text" value="0" readonly />
                                        </th>
                                    </tr>
                                    <tr class="d-none">
                                        <th class="text-end" colspan="3">Đã thanh toán</th>
                                        <th>
                                            <input class="form-control text-end order-detail_paid bg-white" type="text" value="0" readonly />
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6">
                                @if (!empty(Auth::user()->hasAnyPermission(App\Models\User::CREATE_TRANSACTION)))
                                    {{-- <div class="form-check d-inline-block">
                                    <input class="form-check-input" name="paid" type="checkbox" value="1" id="order_paid">
                                    <label class="form-check-label" for="order_paid">
                                        Đã thanh toán
                                    </label>
                                </div> --}}
                                @endif
                            </div>
                            <div class="col-6 text-end">
                                @if (!empty(Auth::user()->hasAnyPermission(App\Models\User::CREATE_TRANSACTION)))
                                    <button class="btn btn-info btn-create-transaction" data-bs-dismiss="modal" type="button">Thanh toán</button>
                                @endif
                                <input name="id" type="hidden">
                                @if (!empty(Auth::user()->hasAnyPermission(App\Models\User::UPDATE_ORDER, App\Models\User::CREATE_ORDER)))
                                    <button class="btn btn-primary" id="order-submit" type="submit">Lưu</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
