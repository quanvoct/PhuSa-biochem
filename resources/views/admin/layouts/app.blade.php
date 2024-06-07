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
    <meta name="apple-mobile-web-app-description" content="Website trực tuyến của Phù Sa Biochem">
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
    {{-- DateRange Picker --}}
    <link type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css" rel="stylesheet" />
    {{-- Include Select2 CSS --}}
    <link href="{{ asset('admin/vendors/select2/select2-bootstrap-5-theme.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/vendors/select2/select2.min.css') }}" rel="stylesheet" />
    {{-- Toastify --}}
    <link href="{{ asset('admin/vendors/toastify/toastify.css') }}" rel="stylesheet">
    {{-- Include sweetalert2 --}}
    <link href="{{ asset('admin/vendors/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    {{-- Print JS --}}
    <link href="{{ asset('admin/vendors/print/print.min.css') }}" rel="stylesheet">
    <!-- Include Summernote Editor -->
    <link href="{{ asset('admin/vendors/summernote/summernote-lite.min.css') }}" rel="stylesheet">
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
            @include('admin.includes.partials.modal_variable')
            @include('admin.includes.partials.modal_catalogue')
            @include('admin.includes.partials.modal_category')
            @include('admin.includes.partials.modal_sort')
            @include('admin.includes.partials.modal_user')
            @include('admin.includes.partials.modal_role')
            @if (Request::path() != 'admin/image')
                <div class="modal fade" id="quick_images-modal" aria-labelledby="quick_images-label" aria-hidden="true" tabindex="-1">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            @include('admin.includes.quick_images')
                        </div>
                    </div>
                </div>
            @endif
            @include('admin.includes.partials.modal_image')
        </div>
    </div>
    <div class="loading d-none">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">{{ __('Loading...') }}</span>
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
    {{-- input image JSCompressor --}}
    <script src="{{ asset('admin/vendors/compressorjs/compressor.min.js') }}"></script>
    {{-- input mask js --}}
    <script src="{{ asset('admin/vendors/jquery-mask/jquery.mask.js') }}"></script>
    {{-- Include Select2 --}}
    <script src="{{ asset('admin/vendors/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/select2/i18n/vi.js') }}"></script>
    {{-- Include moment JS --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/moment.min.js"></script>
    {{-- Include sweetalert2 JS --}}
    <script src="{{ asset('admin/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    {{-- Include daterange picker JS --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>
    {{-- Include Toastify --}}
    <script src="{{ asset('admin/vendors/toastify/toastify.js') }}"></script>
    {{-- Include Summernote Editor --}}
    <script src="{{ asset('admin/vendors/summernote/summernote-lite.min.js') }}"></script>
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
                login: `{{ route('login') }}`,
                storage: "{{ asset(env('FILE_STORAGE', '/storage')) }}",
                placeholder: "{{ asset('admin/images/placeholder.webp') }}",
                getImage: "{{ route('admin.image') }}",
                uploadImage: "{{ route('admin.image.upload') }}",
                updateImage: "{{ route('admin.image.update') }}",
                deleteImage: "{{ route('admin.image.delete') }}",
            },
            dataTable: {
                lang: {
                    sProcessing: "{{ __('Loading...') }}",
                    sLengthMenu: "_MENU_ {{ __('rows/page') }}",
                    sZeroRecords: "{{ __('No data') }}",
                    sInfo: "{{ _('From _START_ to _END_ of _TOTAL_ items') }}",
                    sInfoEmpty: "{{ __('No item') }}",
                    sInfoFiltered: "({{ __('filtered from _MAX_ items') }})",
                    searchPlaceholder: "{{ __('Search') }}",
                    sInfoPostFix: "",
                    sSearch: "{{ __('Search') }}",
                    sUrl: "",
                    oPaginate: {
                        sFirst: "&laquo;",
                        sPrevious: "&lsaquo;",
                        sNext: "&rsaquo;",
                        sLast: "&raquo;",
                    },
                },
                lengths: [
                    [5, 10, 20, 50, 100, 150, 500],
                    [5, 10, 20, 50, 100, 150, 500],
                ],
                pageLength: 20,
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
                    image: {
                        data: "image",
                        name: "image",
                    },
                    sort: {
                        data: "sort",
                        name: "sort",
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
                    author: {
                        data: "author",
                        name: "author",
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
                    image: {
                        data: "image",
                        name: "image",
                    },
                    last_login_at: {
                        data: "last_login_at",
                        name: "last_login_at",
                        render: function render(data, type, row, meta) {
                            return type == "display" ?
                                data != null ?
                                moment(data).format("DD/MM/YYYY HH:mm") :
                                "{{ __('No data') }}" :
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
                        className: 'text-center'
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
                allowClear: true,
                closeOnSelect: false,
                scrollOnSelect: true,
            }
        }

        /**
         * Xử lý hình ảnh
         */
        const table = $('#quick_images-table').DataTable({
            bStateSave: true,
            stateSave: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: `{{ route('admin.image') }}`,
                error: function(err) {
                    if (err.status == 401) {
                        window.location.href = config.routes.login;
                    } else {
                        Swal.fire(`{{ __('An error has occurred') }}!`, err.responseJSON.message, 'error');
                    }
                },
            },
            columns: [
                config.dataTable.columns.id,
                config.dataTable.columns.name, {
                    data: "caption",
                    name: 'caption'
                }, {
                    data: "alt",
                    name: 'alt'
                },
                config.dataTable.columns.author, {
                    data: "link",
                    name: 'link'
                },
                config.dataTable.columns.created_at
            ],
            initComplete: function(settings, json) {
                // show new container for data
                $('#quick_images-grid-view').insertBefore('#quick_images-table');
                $('#quick_images-grid-view').show();
            },
            rowCallback: function(row, data) {
                let text = `<div class="col-6 col-md-3 col-lg-2 my-2">
                        <input class="d-none quick_images-choice" type="checkbox" value="${data.id}" data-name="${data.name}" id="image-${data.id}" name="choices[]" />
                        <label for="image-${data.id}" class="d-block choice-label">
                        <div class="card card-image mb-0">
                        @if (!empty(Auth::user()->can(App\Models\User::DELETE_IMAGE)))
                        <form action="{{ route('admin.image.delete') }}" method="post" class="save-form">
                            @csrf
                            <input type="hidden" name="choices[]" value="${data.id}">
                            <button type="submit" class="btn-close btn-delete-image" aria-label="Close">
                            </button>
                        </form>
                        @endif
                                <div class="ratio ratio-1x1">
                                    <img src="${data.link}" class="card-img-top object-fit-cover p-1" alt="${(data.alt) ? data.alt : ''}">
                                </div>
                                <div class="p-3">
                                    <h6 class="card-title fs-6" data-bs-toggle="tooltip" data-bs-title="${data.name}">${data.name}</h6>
                                    <!-- <p class="card-text">${(data.caption) ? data.caption : ''}</p> -->
                                    <!-- <p class="card-text"><small class="text-body-secondary">${(data.alt) ? data.alt : ''}</small></p> -->
                                    <div class="row justify-content-between">
                                        <div class="col-auto card-text mb-0 me-3"><small class="text-body-secondary">${(data.author) ? data.author.name : ''}</small></div>
                                        <div class="col-auto card-text mb-0"><small class="text-body-secondary">${(data.created_at) ? moment(data.created_at).format('DD/MM/YY HH:mm') : ''}</small></div>
                                    </div>
                                    <div class="row justify-content-between">
                                        <div class="col-auto card-text mb-0 me-3"><small class="text-body-secondary">${(data.size) ? data.size : ''}</small></div>
                                        <div class="col-auto card-text mb-0"><small class="text-body-secondary">${(data.dimension) ? data.dimension : ''}</small></div>
                                    </div>
                                </div>
                            @if (!empty(Auth::user()->can(App\Models\User::READ_IMAGE)))
                            <div class="d-grid">
                                <a class="btn btn-link text-decoration-none btn-sm btn-update-image" data-id="${data.id}">Xem chi tiết</a>
                            </div>
                            @endif
                            </div>
                        </label>
                    </div>`
                $('#quick_images-grid-view').append(text)
            },
            preDrawCallback: function(settings) {
                $('#quick_images-grid-view').empty();
            },
            language: config.dataTable.lang,
            pageLength: 24,
            aLengthMenu: [
                [6, 12, 24, 480],
                [6, 12, 24, 480]
            ],
        });

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
    <script src="{{ asset('admin/js/quick_images.js') }}"></script>
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
                    <td><input type="text" name="variable_sub_sku[]" class="form-control" placeholder="{{ __('Sub SKU') }}"/></td>
                    <td><input type="text" name="variable_name[]" class="form-control" placeholder="{{ __('Variable name') }}"/></td>
                    <td><input type="text" name="variable_unit[]" class="form-control" placeholder="{{ __('Unit') }}"></td>
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
            $.get(` {{ url('admin/product') }}/${id}`, function(obj) {
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
                    <td><input type="text" name="variable_sub_sku[]" class="form-control" placeholder="{{ __('Sub SKU') }}" value="${variable.sub_sku ? variable.sub_sku : ''}"/></td>
                    <td><input type="text" name="variable_name[]" class="form-control" placeholder="{{ __('Variable name') }}" value="${variable.name ? variable.name : ''}"/></td>
                    <td><input type="text" name="variable_unit[]" class="form-control" placeholder="{{ __('Unit') }}" value="${variable.unit ? variable.unit : ''}"></td>
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
            form.find(`[name='image']`).prev().find('img').attr('src', user.imageUrl)
        })

        $('body').on('shown.bs.modal', '#user-modal', function() {
            $(this).find(`#user-country`).attr('data-ajax--url', `{{ route('geolocation.country') }}`).select2(config.select2);
            $('input.select2-search__field').removeAttr('style')
        })

        $('body').on('change', `#user-country`, function name(params) {
            $('#user-form').find(`#user-city`).attr('data-ajax--url', `{{ route('geolocation.city') }}?country=${$(`#user-country`).val()}`).select2(config.select2);
            $('input.select2-search__field').removeAttr('style')
        })

        $(document).on('click', '.btn-update-user', function() {
            const id = $(this).attr('data-id'),
                form = $('#user-form');
            $.get(` {{ url('admin/user') }}/${id}`, function(user) {
                resetForm(form)
                form.attr('action', `{{ route('admin.user.update') }}`)
                form.find(`[name='id']`).val(user.id)
                form.find(`[name='name']`).val(user.name)
                form.find(`[name='email']`).val(user.email)
                form.find(`[name='phone']`).val(user.phone)
                form.find(`[name='birthday']`).val(moment(user.birthday).format('YYYY-MM-DD'))
                form.find(`[name='address']`).val(user.address)
                form.find(`[name='zip']`).val(user.zip)
                form.find(`[name='status']`).prop('checked', user.status)
                let country = new Option(user.country, user.country, false, false)
                form.find(`[name=country]`).html(country).trigger({
                    type: 'select2:select'
                });
                let city = new Option(user.city, user.city, false, false)
                form.find(`[name=city]`).html(city).trigger({
                    type: 'select2:select'
                });
                form.find(`[name='image']`).prev().find('img').attr('src', user.imageUrl)
                form.find('.modal').modal('show')
            })
        })

        $(document).on('click', '.btn-update-user_role', function() {
            const id = $(this).attr('data-id'),
                form = $('#user_role-form');
            resetForm(form)
            form.attr('action', `{{ route('admin.user.update.role') }}`)
            form.find(`[name='id']`).val(id)
            form.find('.modal').modal('show')
        })

        $(document).on('click', '.btn-update-user_password', function() {
            const id = $(this).attr('data-id'),
                form = $('#user_password-form');
            resetForm(form)
            form.attr('action', `{{ route('admin.user.update.password') }}`)
            form.find(`[name='id']`).val(id)
            form.find('.modal').modal('show')
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
            resetForm(form)
            $.get(`{{ url('admin/role') }}/${id}`, function(role) {
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

        $('body').on('shown.bs.modal', '#catalogue-modal', function() {
            $(this).find(`[name=parent_id]`).attr('data-ajax--url', `{{ route('admin.catalogue', ['key' => 'find']) }}`).select2(config.select2);
            $('input.select2-search__field').removeAttr('style')
        })

        $('.btn-refresh-catalogue').click(function() {
            const btn = $(this)
            $.get(`{{ route('admin.catalogue') }}/tree`, function(html) {
                btn.parents('form').find('.catalogue-select .list-group').html(html);
            })
        })

        $(document).on('click', '.btn-update-catalogue', function() {
            const id = $(this).attr('data-id')
            $.get(` {{ url('admin/catalogue') }}/${id}`, function(catalogue) {
                const form = $('#catalogue-form');
                resetForm(form)
                $(form).attr('action', `{{ route('admin.catalogue.update') }}`)
                form.find(`[name='id']`).val(catalogue.id)
                form.find(`[name='name']`).val(catalogue.name)
                form.find(`[name='image']`).val(catalogue.image).change()
                form.find(`[name='description']`).val(catalogue.description)
                form.find(`[name='status']`).prop('checked', catalogue.status)
                if (catalogue.parent_id) {
                    let option = new Option(catalogue.parent.name, catalogue.parent_id, true, true)
                    form.find(`[name=parent_id]`).html(option).trigger({
                        type: 'select2:select'
                    });
                }
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
                    $.get(`{{ url('admin/stock') }}/${id}?customer_id=${form.find('[name=customer_id]').val()}`, function(stock) {
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
            $.get(`{{ url('admin/order') }}/${id}`, function(order) {
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
            form.find('[name=note]').val(order_id ? `{{ __('Pay for order') }} ` + order_id : `{{ __('Pay for debt') }}`)
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
            $.get(` {{ url('admin/transaction') }}/${id}`, function(transaction) {
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

        /**
         * Category process
         */
        $(document).on('click', '.btn-create-category', function(e) {
            e.preventDefault();
            const form = $('#category-form')
            resetForm(form)
            form.find('[name=status]').prop('checked', true);
            form.attr('action', `{{ route('admin.category.create') }}`)
            form.find('.modal').modal('show')
        })

        $(document).on('click', '.btn-update-category', function(e) {
            e.preventDefault();
            const id = $(this).attr('data-id'),
                form = $('#category-form');
            resetForm(form)
            $.get(`{{ route('admin.category') }}/${id}`, function(category) {
                form.find('[name=id]').val(category.id)
                form.find('[name=name]').val(category.name)
                form.find('[name=note]').val(category.note)
                form.find('[name=status]').prop('checked', category.status)
                form.attr('action', `{{ route('admin.category.update') }}`)
                form.find('.modal').modal('show')
            })
        })
    </script>
</body>

</html>
