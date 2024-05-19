<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ffffff">
    <title> @yield('title')- {{ config('app.name', 'Medilabor Admin') }}</title>
    {{-- Thẻ favicon --}}
    <link type="image/x-icon" href="{{ asset('admin/images/favicon.svg') }}" rel="shortcut icon">
    {{-- Định nghĩa web app --}}
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    {{-- Tên và màu nền của web app --}}
    <meta name="apple-mobile-web-app-title" content="MediLabor">
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    {{-- Mô tả của web app --}}
    <meta name="apple-mobile-web-app-description" content="Ứng dụng quản lý bán hàng của MediLabor">
    {{-- Ảnh hiển thị khi thêm vào màn hình Home --}}
    <link href="{{ asset('admin/images/favicon.svg') }}" rel="apple-touch-icon">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="{{ asset('admin/css/bootstrap.css') }}" rel="stylesheet">

    <link href="{{ asset('admin/vendors/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendors/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/key.css') }}" rel="stylesheet">
    <link href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" rel="stylesheet">

    {{-- Include Select2 CSS --}}
    <link href="{{ asset('admin/vendors/select2/select2-bootstrap-5-theme.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/vendors/select2/select2.min.css') }}" rel="stylesheet" />
    {{-- Toastify --}}
    <link href="{{ asset('admin/vendors/toastify/toastify.css') }}" rel="stylesheet">
    {{-- Include sweetalert2 --}}
    <link href="{{ asset('admin/vendors/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    {{-- Print JS --}}
    <link href="{{ asset('admin/vendors/print/print.min.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        @include('admin.includes.sidebar')
        <div class='layout-navbar' id="main">
            @include('admin.includes.header')
            <div id="main-content">
                @yield('content')
                @include('admin.includes.footer')
            </div>
            <div class="d-none" id="print-wrapper"></div>
            @include('admin.includes.partials.modal_transaction')
            @include('admin.includes.partials.modal_order')

            @include('admin.includes.partials.modal_product')
            @include('admin.includes.partials.modal_user')
            @include('admin.includes.partials.modal_role', ['permissions' => Spatie\Permission\Models\Permission::get()])
        </div>
    </div>
    <div class="loading d-none">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <script src="{{ asset('admin/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/jquery/jquery.min.js ') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    {{-- DataTables --}}
    <script src="{{ asset('admin/vendors/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <link href="{{ asset('admin/vendors/datatables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendors/datatables/button/buttons.bootstrap5.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendors/datatables/button/buttons.dataTables.css') }}" rel="stylesheet">
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="{{ asset('admin/vendors/datatables/button/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/datatables/button/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/datatables/button/vfs_fonts.js') }}"></script>
    {{-- Print JS --}}
    <script src="{{ asset('admin/vendors/print/print.min.js') }}"></script>
    {{-- input mask js --}}
    <script src="{{ asset('admin/vendors/jquery-mask/jquery.mask.js') }}"></script>
    {{-- Include Select2 --}}
    <script src="{{ asset('admin/vendors/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/select2/i18n/vi.js') }}"></script>
    {{-- data range! --}}
    <link type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css" rel="stylesheet" />
    {{-- Include moment JS --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/moment.min.js"></script>
    {{-- Include sweetalert2 JS --}}
    <script src="{{ asset('admin/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    {{-- Include daterange picker JS --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>
    {{-- Include Toastify --}}
    <script src="{{ asset('admin/vendors/toastify/toastify.js') }}"></script>
    <script type="text/javascript">
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register(`{{ asset('js/service-worker.js') }}`).then(function(registration) {
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                }, function(err) {
                    console.error('ServiceWorker registration failed: ', err);
                });
            });
        }
    </script>
    <script type="text/javascript">
        const config = {
            routes: {
                login: `{{ route('login') }}`
            },
            dataTable: {
                lang: {
                    sProcessing: "Đang xử lý...",
                    sLengthMenu: "_MENU_ dòng/trang",
                    sZeroRecords: "Nội dung trống.",
                    sInfo: "Từ _START_ đến _END_ của _TOTAL_ mục",
                    sInfoEmpty: "Không có mục nào",
                    sInfoFiltered: "(được lọc từ _MAX_ mục)",
                    searchPlaceholder: "Tìm kiếm dữ liệu",
                    sInfoPostFix: "",
                    sSearch: "Tìm kiếm",
                    sUrl: "",
                    oPaginate: {
                        sFirst: "&laquo;",
                        sPrevious: "&lsaquo;",
                        sNext: "&rsaquo;",
                        sLast: "&raquo;",
                    },
                },
                length: [
                    [5, 10, 20, 50, 100, 150, 500],
                    [5, 10, 20, 50, 100, 150, 500],
                ],
                columnDefines: [{
                        target: 0,
                        sortable: false,
                        searchable: false,
                    },
                    {
                        target: $("#data-table thead tr th").length - 1,
                        sortable: false,
                        searchable: false,
                    },
                ],
                columns: {
                    checkboxes: {
                        data: "checkboxes",
                        name: "checkboxes",
                    },
                    id: {
                        data: "id",
                        name: "id",
                    },
                    customer: {
                        data: "customer",
                        name: "customer",
                    },
                    dealer: {
                        data: "dealer",
                        name: "dealer",
                    },
                    user: {
                        data: "user",
                        name: "user",
                    },
                    receiver: {
                        data: "receiver",
                        name: "receiver",
                    },
                    order: {
                        data: "order",
                        name: "order",
                    },
                    cashier: {
                        data: "cashier",
                        name: "cashier",
                    },
                    payment: {
                        data: "payment",
                        name: "payment",
                    },
                    unit: {
                        data: "unit",
                        name: "unit",
                    },
                    sku: {
                        data: "sku",
                        name: "sku",
                    },
                    organ: {
                        data: "organ",
                        name: "organ",
                    },
                    tax_id: {
                        data: "tax_id",
                        name: "tax_id",
                    },
                    lot: {
                        data: "lot",
                        name: "lot",
                    },
                    quantity: {
                        data: "quantity",
                        name: "quantity",
                    },
                    price: {
                        data: "price",
                        name: "price",
                        className: 'text-end',
                        render: function render(data, type, row) {
                            return (type = 'display' ? number_format(data) + 'đ' : 0);
                        },
                    },
                    expired: {
                        data: "expired",
                        name: "expired",
                        render: function render(data, type, row) {
                            return (type = 'display' ?
                                data != null ?
                                moment(data).format("DD/MM/YYYY") :
                                "" :
                                0);
                        },
                    },
                    amount: {
                        data: "amount",
                        name: "amount",
                        className: 'text-end',
                        render: function render(data, type, row) {
                            return (type = 'display' ? number_format(data) : 0);
                        },
                    },
                    roles: {
                        data: "roles",
                        name: "roles",
                    },
                    name: {
                        data: "name",
                        name: "name",
                        className: "text-start",
                    },
                    email: {
                        data: "email",
                        name: "email",
                    },
                    phone: {
                        data: "phone",
                        name: "phone",
                    },
                    address: {
                        data: "address",
                        name: "address",
                    },
                    last_login_at: {
                        data: "last_login_at",
                        name: "last_login_at",
                        render: function render(data, type, row, meta) {
                            return type == "display" ?
                                data != null ?
                                moment(data).format("DD/MM/YYYY HH:mm") :
                                "Chưa đăng nhập" :
                                data;
                        },
                    },
                    created_at: {
                        data: "created_at",
                        name: "created_at",
                        className: 'text-center',
                        render: function render(data, type, row) {
                            return (type == 'display' ? (data != null ? moment(data).format("DD/MM/YYYY H:mm") : "") : data);
                        },
                    },
                    status: {
                        data: "status",
                        name: "status",
                    },
                    note: {
                        data: "note",
                        name: "note",
                    },
                    action: {
                        data: "action",
                        name: "action",
                    },
                }
            },
            select2: {
                ajax: {
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data,
                            pagination: {
                                more: false
                            }
                        }
                    },
                    cache: 500,
                    delay: true,
                },
                language: "vi",
                theme: "bootstrap-5",
                width: '100%',
                allowClear: false,
                closeOnSelect: false,
                scrollOnSelect: true,
            }
        }

        /**
         * Hàm xử lý lỗi ajax DataTables
         */
        function dataTableErrorProcess(err) {
            if (err.status == 401 || err.status == 419) {
                console.warn(err.responseJSON.errors);
                window.location.href = config.routes.login;
            } else {
                console.log("Error:", err);
                Swal.fire(
                    "{{ __('\u0110\xC3 C\xD3 L\u1ED6I X\u1EA2Y RA!') }}",
                    err.responseJSON.$message,
                    "error"
                );
            }
        }

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $(document).on('click', '.btn-print-order', function() {
                const id = $(this).attr('data-id'),
                    type = $(this).attr('data-type')
                $.get(`{{ route('admin.order') }}/${id}`, function(order) {
                    $('#print-wrapper').html(printTemplate(order, type))
                    printJS({
                        printable: 'print-container',
                        type: 'html',
                        css: [`{{ asset('admin/css/bootstrap.css') }}`, `{{ asset('admin/css/key.css') }}`],
                        targetStyles: ['*'],
                        showModal: false,
                    });
                })
            });

            function printTemplate(order, type) {
                console.log(order);
                let str = '',
                    total = 0,
                    head = (type == 'company') ?
                    `<div class="row justify-content-md-center" style="line-height: 1em; corlor: #000 !important">
                            <div class="col-5 ml-3">
                                <img src="{{ asset('admin/images/logo.svg') }}" width="200px"><br/>
                                <small class="text-muted">Mẫu số 02-VT<br/>(Ban hành theo Thông tư số 200/2004/TT-BTC<br/>Ngày 22/12/2014 của Bộ Tài chính)</small>
                            </div>
                            <div class="col-6">
                                <h6 class="text-center mb-0" style="margin-top: 10px; color: #009edb;">CÔNG TY TNHH THƯƠNG MẠI DỊCH VỤ</h6>
                                <h4 class="text-center mb-0" style="color: #009edb;"><strong>MEDI.LABOR</strong></h4>
                                <p class="text-center"><small>319M, KV5, P. An Khánh, Q. Ninh Kiều, TP. Cần Thơ<br/>
                                ĐT: 0943 309 792 - MST: 1 8 0 1 6 2 6 9 6 1</small></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h2 class="text-center text-primary mb-0"><strong>PHIẾU GIAO HÀNG</strong></h2>
                                <p class="text-center"><small>Số phiếu: ${order.id} | Ngày ${moment(order.created_at).format('DD')} tháng ${moment(order.created_at).format('MM')} năm ${moment(order.created_at).format('YYYY')}</small></p>
                            </div>
                        </div>` : `
                        <div class="row justify-content-md-center" style="line-height: 1em;">
                            <div class="col-3 ml-1">
                                <img src="{{ asset('admin/images/logo-TM.svg') }}" width="120px"><br />
                            </div>
                            <div class="col-8">
                                <h5 class="text-center mb-0" style="margin-top: 10px; color: #009edb;"><strong>CỬA HÀNG VẬT TƯ - THIẾT BỊ Y TẾ TIẾN MINH</strong></h5>
                                <p class="text-center"><small>212 đường B3, KDC Thới Nhựt, KV1, P. An Khánh, Q. Ninh Kiều, TP. Cần Thơ<br />
                                        ĐT: 0943 309 792 - MST: 8 0 2 0 6 7 9 2 7 1</small></p>
                                <h2 class="text-center text-primary mb-0"><strong>PHIẾU GIAO HÀNG</strong></h2>
                                <p class="text-center"><small>Số phiếu: ${order.id} | Ngày ${moment(order.created_at).format('DD')} tháng ${moment(order.created_at).format('MM')} năm ${moment(order.created_at).format('YYYY')}</small></p>
                            </div>
                        </div>`
                $.each(order.details, function(i, detail) {
                    total += detail.price * detail.quantity
                    str +=
                        `<tr>
                            <td class="text-center">${i+1}</td>
                            <td>${ detail._stock._variable._product.name + ' - ' + detail._stock._variable.name }</td>
                            <td class="text-center">${ detail._stock._variable.unit }</td>
                            <td class="text-center">${ detail.quantity }</td>
                            <td class="text-end">${ number_format(detail.price) }đ</td>
                            <td class="text-end">${ number_format(detail.price * detail.quantity) }đ</td>
                        </tr>`
                })
                return `
                    <div id="print-container">
                        <div id="print-table">
                            ${ head }
                            <div class="row justify-content-md-center text-dark" style="padding: 0 50px;">
                                <div class="col-3 mb-0">
                                    <p class="text-left mb-0"><strong>Khách hàng:</strong></p>
                                </div>
                                <div class="col-8 mb-0">
                                    <p class="text-left mb-0"><strong>${order._customer.name + ((order._customer.organ != null) ? ' - ' + order._customer.organ : '')}</strong></p>
                                </div>
                                <div class="col-3 mb-0">
                                    <p class="text-left mb-0">Địa chỉ:</p>
                                </div>
                                <div class="col-8 mb-0">
                                    <p class="text-left mb-0">${order._customer.address}</p>
                                </div>
                                <div class="col-3 mb-0">
                                    <p class="text-left mb-0">Điện thoại:</p>
                                </div>
                                <div class="col-8 mb-0">
                                    <p class="text-left mb-0">${order._customer.phone}</p>
                                </div>
                                ${(order._customer.tax_id != null) ? `
                                    <div class="col-3 mb-0">
                                        <p class="text-left">MST:</p>
                                    </div>
                                    <div class="col-8 mb-0">
                                        <p class="text-left">${order._customer.tax_id}</p>
                                    </div>` : ``}
                            </div>
                            <div class="text-dark">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên hàng</th>
                                            <th>ĐVT</th>
                                            <th>Số lượng</th>
                                            <th>Đơn giá</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${str}
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5">Tổng</th>
                                            <th class="text-end">${number_format(total)}đ</th>
                                        </tr>
                                        ${ order.discount > 0 ? `
                                            <tr>
                                                <th colspan="5">Giảm giá</th>
                                                <th class="text-end">${number_format(order.discount)}đ</th>
                                            </tr>
                                            <tr>
                                                <th colspan="5">Còn lại</th>
                                                <th class="text-end">${number_format(total - order.discount)}đ</th>
                                            </tr>` : ''
                                        }
                                        ${ order.paid > 0 ? `
                                            <tr>
                                                <th colspan="5">Trả trước</th>
                                                <th class="text-end">${number_format(order.paid)}đ</th>
                                            </tr>
                                            <tr>
                                                <th colspan="5">Phải thanh toán</th>
                                                <th class="text-end">${number_format(total - order.discount - order.paid)}đ</th>
                                            </tr>` : ''
                                        }
                                    </tfoot>
                                </table>
                            </div>
                            <hr>
                            <div class="row  justify-content-around" style="padding: 0 50px; min-height: 150px;">
                                <div class="col-6 mb-0">
                                    <p class="text-center mb-0">Giao hàng<br /><small><em>(Ký và ghi rõ họ tên)</em></small></p>
                                </div>
                                <div class="col-6 mb-0">
                                    <p class="text-center mb-0">Người nhận<br /><small><em>(Ký và ghi rõ họ tên)</em></small></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-center text-dark">Giao hàng nhanh trong 24 giờ</p>
                                </div>
                            </div>
                        </div>
                    </div>`
            }
        })
    </script>
    <script src="{{ asset('admin/js/main.js') }}"></script>
    @stack('scripts')
    <script type="text/javascript">
        /**
         * Product process
         */
        $('.btn-create-product').click(function() {
            const form = $('#product-form')
            resetForm(form)
            initialCreateProduct()
        })

        function initialCreateProduct() {
            $('#product-variables').empty()
            $('[name=status]').prop('checked', true)
            $('.btn-create-variable').trigger('click')
            $('#product-form').attr('action', `{{ route('admin.product.create') }}`)
            $('#product-modal').modal('show')
        }

        $('.btn-create-variable').click(function(e) {
            e.preventDefault()
            $('#product-variables').append(`
                <tr>
                    <td><input type="text" name="variable_sub_sku[]" class="form-control" placeholder="Mã"/></td>
                    <td><input type="text" name="variable_name[]" class="form-control" placeholder="Tên biến thể"/></td>
                    <td><input type="text" name="variable_unit[]" class="form-control" placeholder="Đơn vị tính"></td>
                    <td>
                        <input type="hidden" name="variable_id[]" />
                        <form method="post" action="{{ route('admin.variable.remove') }}">
                            <input type="hidden" name="choices[]" />
                            <button type="submit" class="btn btn-outline-danger btn-remove-detail variable">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                `)
        })

        $('body').on('shown.bs.modal', '#product-modal', function() {
            $(this).find(`[name='catalogue_id[]']`).attr('data-ajax--url', `{{ route('admin.catalogue', ['id' => 'find']) }}`).select2(config.select2);
            $('input.select2-search__field').removeAttr('style')
        })

        $(document).on('click', '.btn-update-product', function() {
            const id = $(this).attr('data-id')
            $.get(` {{ url('product') }}/${id}`, function(obj) {
                const form = $('#product-form');
                resetForm(form)
                form.find(`[name='id']`).val(obj.id)
                form.find(`[name='sku']`).val(obj.sku)
                form.find(`[name='name']`).val(obj.name)
                let option = ''
                obj.catalogues.forEach(catalogue => {
                    option += `<option value="${catalogue.id}" selected>${catalogue.name}</option>`
                });
                form.find(`[name='catalogue_id[]']`).html(option).trigger({
                    type: 'select2:select'
                });
                form.find(`[name='note']`).val(obj.note)
                let str = ''
                obj.variables.forEach(variable => {
                    str += htmlVariable(variable)
                });
                $('#product-variables').empty().html(str)
                form.find(`[name='status']`).prop('checked', obj.status)
                $('#product-form').attr('action', `{{ route('admin.product.update') }}`)
                form.find('.modal').modal('show')
            })
        })

        function htmlVariable(variable) {
            return `
                <tr>
                    <td><input type="text" name="variable_sub_sku[]" class="form-control" placeholder="Mã" value="${variable.sub_sku ? variable.sub_sku : ''}"/></td>
                    <td><input type="text" name="variable_name[]" class="form-control" placeholder="Tên biến thể" value="${variable.name ? variable.name : ''}"/></td>
                    <td><input type="text" name="variable_unit[]" class="form-control" placeholder="Đơn vị tính" value="${variable.unit ? variable.unit : ''}"></td>
                    <td>
                        <input type="hidden" name="variable_id[]" value="${variable.id}"/>
                        <form method="post" action="{{ route('admin.variable.remove') }}">
                            <input type="hidden" name="choices[]" value="${variable.id}"/>
                            <button type="submit" class="btn btn-outline-danger btn-remove-detail variable">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>`;
        }

        /**
         * User process
         */
        $('.btn-create-user').click(function(e) {
            e.preventDefault();
            $('#user-form').attr('action', `{{ route('admin.user.create') }}`)
            $('#user-modal').modal('show')
            resetForm($('#user-form'))
        })

        $(document).on('click', '.btn-update-user', function() {
            const id = $(this).attr('data-id')
            $('#user-form').attr('action', `{{ route('admin.user.update') }}`)
            $.get(` {{ url('user') }}/${id}`, function(user) {
                const form = $('#user-form');
                resetForm(form)
                form.find(`[name='id']`).val(user.id)
                form.find(`[name='name']`).val(user.name)
                form.find(`[name='email']`).val(user.email)
                form.find(`[name='phone']`).val(user.phone)
                form.find(`[name='address']`).val(user.address)
                if (user.roles.length) {
                    form.find(`[name='role_id']`).val(user.roles[0].id)
                }
                if (user.stores.length) {
                    form.find(`[name='store_id']`).val(user.stores[0].id)
                }
                form.find(`[name='status']`).prop('checked', user.status)
                form.find('.modal').modal('show')
            })
        })

        /**
         * Role process
         */
        $('.btn-create-role').click(function(e) {
            e.preventDefault();
            $('#role-form').attr('action', `{{ route('admin.role.create') }}`);
            $('#role-modal').modal('show');
            resetForm($('#role-form'))
        })

        $(document).on('click', '.btn-update-role', function() {
            const id = $(this).attr('data-id'),
                form = $('#role-form');
            resetForm($('#role-form'))
            $.get(`{{ url('role/get/') }}/${id}`, function(role) {
                form.find('[name=name]').val(role.name)
                form.find('[name=id]').val(role.id)
                $.each(role.permissions, function(index, permission) {
                    form.find('input[value=' + permission.id + ']').prop('checked', true)
                })
                form.attr('action', `{{ route('admin.role.update') }}`)
                form.find('.modal').modal('show')
            })
        })

        /**
         * Catalogue process
         */
        $('.btn-create-catalogue').click(function(e) {
            e.preventDefault();
            resetForm($('#catalogue-form'))
            $('#catalogue-form').attr('action', `{{ route('admin.catalogue.create') }}`).find('[name=status]').prop('checked', true)
            $('#catalogue-modal').modal('show')
        })


        $(document).on('click', '.btn-update-catalogue', function() {
            const id = $(this).attr('data-id')
            $('#catalogue-form').attr('action', `{{ route('admin.catalogue.update') }}`)
            $.get(` {{ url('catalogue') }}/${id}`, function(catalogue) {
                const form = $('#catalogue-form');
                resetForm(form)
                form.find(`[name='id']`).val(catalogue.id)
                form.find(`[name='name']`).val(catalogue.name)
                form.find(`[name='note']`).val(catalogue.note)
                form.find(`[name='status']`).prop('checked', catalogue.status)
                form.find('.modal').modal('show')
            })
        })

        /**
         * Order process
         */
        $('.btn-create-order').click(function(e) {
            e.preventDefault();
            $('.order-detail_paid').parents('tr').addClass('d-none')
            resetForm($('#order-form'))
            $('#order-details').empty()
            $('[name=status][value=1]').prop('checked', true)
            $('#order-form').attr('action', `{{ route('admin.order.create') }}`)
            $('#order-modal').modal('show')
            $('.btn-create-transaction').addClass('d-none').removeAttr('data-order').removeAttr('data-customer').removeAttr('data-amount')
        })

        $('.btn-create-detail').click(function(e) {
            e.preventDefault();
            let form = $('#order-form'),
                id = form.find(`[name='order_stock']`).val(),
                btn = $(this),
                existStock = false
            $('.order-detail_stock_id').each(function(i, input) {
                if (input.value == id) {
                    existStock = true
                    return false
                }
            })
            if (!existStock) {
                if (id && !isNaN(id)) {
                    btn.prop("disabled", true).html('<span class="spinner-border spinner-border-sm" id="spinner-form" role="status"></span>');
                    $.get(`{{ url('stock') }}/${id}?customer_id=${form.find('[name=customer_id]').val()}`, function(stock) {
                        const str = `
                            <tr class="order-detail">
                                <td>
                                    <input type="text" class="form-control bg-white" value="${stock._variable._product.name + ' - ' + stock._variable.name}" required readonly/>
                                    <input type="hidden" name="detail_stock_id[]" class="order-detail_stock_id" value="${stock.id}" required />
                                    <input type="hidden" class="order-detail_stock_quantity" value="${stock.quantity}" />
                                </td>
                                <td>
                                    <input type="text" name="detail_quantity[]" value="${1}" class="form-control order-detail_quantity text-end" onclick="this.select()" placeholder="Nhập số" inputmode="numeric" required/>
                                </td>
                                <td>
                                    <input name="detail_price[]" value="${stock.price}" class="form-control money order-detail_price text-end" onclick="this.select()" inputmode="numeric" placeholder="Giá bán">
                                </td>
                                <td>
                                    <input type="text" value="${number_format(stock.price)}" class="form-control text-end order-detail_total bg-white" readonly/>
                                </td>
                                <td>
                                    <input type="hidden" name="detail_id[]" />
                                    <form method="post" action="{{ route('admin.order_detail.remove') }}">
                                        <input type="hidden" name="choices[]" />
                                        <button type="submit" class="btn btn-outline-danger btn-remove-detail order">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>`;
                        $('#order-details').append(str);
                        calcOrder()
                        btn.prop("disabled", false).html('<i class="bi bi-plus-circle"></i> Thêm');
                    })
                } else {
                    Toastify({
                        text: "Hãy chọn một sản phẩm.",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "var(--bs-warning)",
                    }).showToast();
                }
            } else {
                Toastify({
                    text: "Sản phẩm đã được thêm trước đó.",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "var(--bs-danger)",
                }).showToast();
            }
        });

        $(document).on('click', '.btn-remove-detail.order', function() {
            !$('.order-detail').length ? $('.order-detail_summary').parents('tr').addClass('d-none').next().addClass('d-none') : ''
            calcOrder()
        })

        $(document).on('change', '.order-detail_stock_id, .order-detail_price, .order-detail_quantity, .order-discount', function() {
            setTimeout(() => {
                let stock_id = $(this).parents('tr').find('.order-detail_stock_id').val(),
                    price = $(this).parents('tr').find(`.order-detail_price`).val().split(',').join(''),
                    stock = $(this).parents('tr').find(`.order-detail_stock_quantity`).val(),
                    quantity = $(this).parents('tr').find('.order-detail_quantity').val().split(',').join('')
                if (parseInt(stock) < parseInt(quantity)) {
                    $(this).parents('tr').find('.order-detail_quantity').val(stock)
                    quantity = stock
                    Toastify({
                        text: "Gói tồn kho không đủ hàng, vui lòng chọn gói khác bổ sung.",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "var(--bs-danger)",
                    }).showToast();
                }
                $(this).parents('tr').find('.order-detail_total').val(number_format(price * quantity))
                calcOrder()
            }, 200);
        })

        $(document).on('change', '.order-discount', function() {
            const value = parseFloat($(this).val().split(',').join(''))
            if (value > 1000) {
                calcOrder()
            } else {
                $(this).val(0).change()
                Toastify({
                    text: "Số tiền giảm giá phải lớn hơn 1000đ",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "var(--bs-danger)",
                }).showToast();
            }
        })

        function calcOrder() {
            let summary = 0
            $('.order-detail_total').each(function(i, input) {
                summary += parseFloat(input.value.split(',').join(''))
            })
            $('.order-detail_summary').val(number_format(summary)).parents('tr').removeClass('d-none')
            if ($('.order-discount').val().split(',').join('') > 0) {
                $('.order-detail_discount')
                    .val(number_format($('.order-discount').val()))
                    .parents('tr').removeClass('d-none')
                    .next().removeClass('d-none')
                    .find('.order-detail_remain')
                    .val(number_format(summary - parseInt($('.order-discount').val().split(',').join(''))))
            } else {
                $('.order-detail_discount').parents('tr').addClass('d-none').next().addClass('d-none')
            }
        }

        $('body').on('shown.bs.modal', '#order-modal', function() {
            $(this).find('[name=customer_id]').attr('data-ajax--url', `{{ route('admin.user', ['id' => 'find']) }}`).select2(config.select2);
        })

        $(document).on('click', '.btn-update-order', function() {
            const id = $(this).attr('data-id'),
                form = $('#order-form')
            resetForm(form)
            $('#order-form').attr('action', `{{ route('admin.order.update') }}`)
            $.get(`{{ url('order') }}/${id}`, function(order) {
                if (order.total - order.paid > 0) {
                    $('.btn-create-transaction').removeClass('d-none').attr('data-order', order.id).attr('data-customer', order.customer_id).attr('data-amount', order.total - order.paid)
                } else {
                    $('.btn-create-transaction').addClass('d-none').removeAttr('data-order').removeAttr('data-customer').removeAttr('data-amount')
                    $('[name=paid]').prop('checked', true)
                }
                if (order.paid > 0) {
                    $('.order-detail_paid').val(number_format(order.paid)).parents('tr').removeClass('d-none')
                } else {
                    $('.order-detail_paid').val(0).parents('tr').addClass('d-none')
                }
                form.find(`[name='id']`).val(order.id)

                $.get(`{{ route('admin.user') }}/${order.customer_id}`).then(function(customer) {
                    var option = new Option(customer.name, customer.id, true, true);
                    form.find('[name=customer_id]').html(option).trigger({
                        type: 'select2:select'
                    });
                });
                form.find(`[name='dealer_id']`).val(order.dealer_id)
                form.find(`[name='status'][value='${order.status}']`).prop('checked', true)
                form.find(`[name='discount']`).val(order.discount)
                form.find(`[name='note']`).val(order.note)
                let str = ''
                order.details.forEach(detail => {
                    str += htmlOrderDetail(detail)
                });
                $('#order-details').empty().html(str)
                form.find('.modal').modal('show')
                calcOrder()
            })
        })

        function htmlOrderDetail(detail) {
            return `
                <tr class="order-detail">
                    <td>
                        <input type="text" class="form-control bg-white" value="${detail._stock._variable._product.name + ' - ' + detail._stock._variable.name}" required readonly/>
                        <input type="hidden" name="detail_stock_id[]" class="order-detail_stock_id" value="${detail._stock.id}" required />
                        <input type="hidden" class="order-detail_stock_quantity" value="${detail._stock.quantity + detail.quantity}" />
                    </td>
                    <td>
                        <input type="text" name="detail_quantity[]" value="${detail.quantity}" class="form-control order-detail_quantity money text-end" onclick="this.select()" placeholder="Nhập số" inputmode="numeric" required/>
                    </td>
                    <td>
                        <input name="detail_price[]" value="${detail.price}" class="form-control money order-detail_price text-end" onclick="this.select()" inputmode="numeric" placeholder="Giá bán">
                    </td>
                    <td>
                        <input type="text" value="${number_format(detail.price * detail.quantity)}" class="form-control text-end money order-detail_total bg-white" readonly/>
                    </td>
                    <td>
                        <input type="hidden" name="detail_id[]" value="${detail.id}"/>
                        <form method="post" action="{{ route('admin.order_detail.remove') }}">
                            <input type="hidden" name="choices[]" value="${detail.id}"/>
                            <button type="submit" class="btn btn-outline-danger btn-remove-detail order">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>`;
        }

        /**
         * Transaction process
         */
        $(document).on('click', '.btn-create-transaction', function(e) {
            e.preventDefault();
            const form = $('#transaction-form'),
                order_id = $(this).attr('data-order'),
                customer_id = $(this).attr('data-customer'),
                amount = $(this).attr('data-amount');
            resetForm(form)

            $.get(`{{ route('admin.user') }}/${customer_id}`).then(function(customer) {
                var option = new Option(customer.name, customer.id, true, true);
                form.find('[name=customer_id]').html(option).trigger({
                    type: 'select2:select'
                });
            });
            form.find(`[name='order_id']`).val(order_id)
            form.find('[name=amount]').val(amount)
            form.find('[name=note]').val(order_id ? 'Thanh toán đơn hàng ' + order_id : 'Thanh toán công nợ')
            form.find('[name=cashier_id]').val(`{{ Auth::user()->id }}`)
            form.attr('action', `{{ route('admin.transaction.create') }}`)
            form.find('.modal').modal('show')
        })

        $('body').on('shown.bs.modal', '#transaction-modal', function() {
            $(this).find('[name=customer_id]').attr('data-ajax--url', `{{ route('admin.user', ['id' => 'find']) }}`).select2(config.select2);
        })

        $(document).on('click', '.btn-update-transaction', function() {
            const id = $(this).attr('data-id'),
                customer_id = $(this).attr('data-customer_id')
            const form = $('#transaction-form');
            form.find(`[name='id']`).val(id);
            form.attr('action', `{{ route('admin.transaction.update') }}`)
            $.get(` {{ url('transaction') }}/${id}`, function(transaction) {
                var option = new Option(transaction._customer.name, transaction._customer.id, true, true);
                form.find('[name=customer_id]').html(option).trigger({
                    type: 'select2:select'
                });
                form.find(`[name='order_id']`).val(transaction.order_id);
                form.find(`[name='cashier_id']`).val(transaction.cashier_id)
                form.find(`[name='amount']`).val(transaction.amount)
                form.find(`[name='note']`).val(transaction.note)
                form.find(`[name='payment'][value = '${transaction.payment}']`).prop('checked', true)
                form.find(`[name='status'][value = '${transaction.status}']`).prop('checked', true)
                form.find('.modal').modal('show')
            })
        })
    </script>
</body>

</html>
