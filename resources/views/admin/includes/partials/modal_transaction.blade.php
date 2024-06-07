<form class="save-form" id="transaction-form" name="transaction" method="post">
    @csrf
    <div class="modal fade" id="transaction-modal" aria-labelledby="transaction-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="transaction-modal-label">{{ __('Transaction') }}</h1>
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
                                <label for="transaction-customer_id">{{ __('Customer') }}</label>
                            </div>
                            <div class="col-8">
                                <select class="form-select select2" id="transaction-customer_id" name="customer_id" data-placeholder="{{ __('Choose a person') }}">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-4 my-auto">
                                <label for="transaction-cashier_id">{{ __('Cashier') }}</label>
                            </div>
                            <div class="col-8">
                                <select class="form-select" id="transaction-cashier_id" name="cashier_id">
                                    <option selected disabled hidden>{{ __('Choose a person') }}</option>
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
                                <label class="form-label" for="transaction-cash">{{ __('Payments') }}</label>
                            </div>
                            <div class="col-8">
                                <div class="my-3 me-5">
                                    <div class="btn-group">
                                        <input class="btn-check" id="transaction-cash" name="payment" type="radio" value="0" checked>
                                        <label class="btn btn-outline-primary" for="transaction-cash">
                                            {{ __('Cash') }}
                                        </label>
                                        <input class="btn-check" id="transaction-transfer" name="payment" type="radio" value="1">
                                        <label class="btn btn-outline-primary" for="transaction-transfer">
                                            {{ __('Transfer') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-4 my-auto">
                                <label for="transaction-amount">{{ __('Amount') }}</label>
                            </div>
                            <div class="col-8">
                                <input class="form-control w-50 transaction-amount money" id="transaction-amount" name="amount" type="text" value="0" placeholder="{{ __('Amount') }}" onclick="this.select()" inputmode="numeric">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-4 my-auto">
                                <label for="transaction-note">{{ __('Note') }}</label>
                            </div>
                            <div class="col-8">
                                <input class="form-control" id="transaction-note" name="note" type="text" placeholder="{{ __('Enter payment note') }}">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-4 my-auto">
                                <label class="form-label" for="transaction-cashback">{{ __('Status') }}</label>
                            </div>
                            <div class="col-8">
                                <div class="my-3">
                                    <div class="btn-group">
                                        <input class="btn-check" id="transaction-normal" name="status" type="radio" value="1" checked>
                                        <label class="btn btn-outline-primary" for="transaction-normal">
                                            {{ __('Checkout') }}
                                        </label>
                                        <input class="btn-check" id="transaction-cashback" name="status" type="radio" value="0">
                                        <label class="btn btn-outline-primary" for="transaction-cashback">
                                            {{ __('Refund') }}
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
                                {{ __('Save') }}
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</form>
