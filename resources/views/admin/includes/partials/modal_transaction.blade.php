<form class="save-form" id="transaction-form" name="transaction" method="post">
    @csrf
    <div class="modal fade" id="transaction-modal" aria-labelledby="transaction-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="transaction-modal-label">Giao dịch</h1>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-4 my-auto">
                                <label for="transaction-order">Đơn hàng</label>
                            </div>
                            <div class="col-8">
                                <select class="form-select transaction-order combobox" id="transaction-order" name="order_id">
                                </select>
                            </div>
                        </div>
                    </div> --}}
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-4 my-auto">
                                <label for="transaction-customer_id">Khách hàng</label>
                            </div>
                            <div class="col-8">
                                <select class="form-select select2" id="transaction-customer_id" name="customer_id" data-placeholder="Chọn một khách hàng">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-4 my-auto">
                                <label for="transaction-cashier_id">Thu ngân</label>
                            </div>
                            <div class="col-8">
                                <select class="form-select" id="transaction-cashier_id" name="cashier_id">
                                    <option selected disabled hidden>Chọn thu ngân</option>
                                    @foreach (app\Models\User::permission(app\Models\User::CREATE_TRANSACTION) as $index => $cashier)
                                        <option value="{{ $cashier->id }}">{{ $cashier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-4 my-auto">
                                <label class="form-label" for="transaction-cash">Hình thức</label>
                            </div>
                            <div class="col-8">
                                <div class="my-3 me-5">
                                    <div class="btn-group">
                                        <input class="btn-check" id="transaction-cash" name="payment" type="radio" value="0" checked>
                                        <label class="btn btn-outline-primary" for="transaction-cash">
                                            Tiền mặt
                                        </label>
                                        <input class="btn-check" id="transaction-transfer" name="payment" type="radio" value="1">
                                        <label class="btn btn-outline-primary" for="transaction-transfer">
                                            Chuyển khoản
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-4 my-auto">
                                <label for="transaction-amount">Số tiền</label>
                            </div>
                            <div class="col-8">
                                <h5>
                                    <div class="input-group">
                                        <input class="form-control w-50 transaction-amount money" id="transaction-amount" name="amount" type="text" value="0" placeholder="Số tiền thanh toán" onclick="this.select()" inputmode="numeric">
                                        <span class="input-group-text">VND</span>
                                    </div>
                                </h5>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-4 my-auto">
                                <label for="transaction-value">Khách đưa</label>
                            </div>
                            <div class="col-8">
                                <div class="input-group">
                                    <input type="text" class="form-control w-50 pay-receive"
                                        id="transaction-value" name="receive" placeholder="Vui lòng nhập giá">
                                    <span class="input-group-text">VND</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-4 my-auto">
                                <label for="transaction-return">Tiền thừa</label>
                            </div>
                            <div class="col-8">
                                <div class="input-group">
                                    <input type="text" class="form-control w-50 return-amount bg-white" id="transaction-return" name="return" value="0" readonly>
                                    <span class="input-group-text">VND</span>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-4 my-auto">
                                <label for="transaction-note">Nội dung</label>
                            </div>
                            <div class="col-8">
                                <input class="form-control" id="transaction-note" name="note" type="text" placeholder="Nhập nội dung thanh toán">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-4 my-auto">
                                <label class="form-label" for="transaction-cashback">Trạng thái</label>
                            </div>
                            <div class="col-8">
                                <div class="my-3">
                                    <div class="btn-group">
                                        <input class="btn-check" id="transaction-normal" name="status" type="radio" value="1" checked>
                                        <label class="btn btn-outline-primary" for="transaction-normal">
                                            Thu tiền
                                        </label>
                                        <input class="btn-check" id="transaction-cashback" name="status" type="radio" value="0">
                                        <label class="btn btn-outline-primary" for="transaction-cashback">
                                            Hoàn tiền
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="px-5">
                    <div class="mb-3 text-end">
                        @if (!empty(Auth::user()->hasAnyPermission(App\Models\User::UPDATE_TRANSACTION, App\Models\User::CREATE_TRANSACTION)))
                            <input name="id" type="hidden">
                            <input name="order_id" type="hidden">
                            <button class="btn btn-primary" id="transaction-submit" type="submit">
                                Lưu
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</form>
