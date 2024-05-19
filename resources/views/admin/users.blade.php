@extends('admin.layouts.app')
@section('title')
    {{ $pageName }}
@endsection
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $pageName }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Bảng tin</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $pageName }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section>
            <div class="card">
                <div class="card-header">
                    @if (!empty(Auth::user()->can(App\Models\User::CREATE_USER)))
                        <button type="button" class="btn btn-primary btn-create-user">
                            <i class="bi bi-plus-circle"></i> Thêm
                        </button>
                    @endif
                    @if (!empty(Auth::user()->can(App\Models\User::DELETE_USERS)))
                        <button type="button" class="btn btn-danger btn-remove-user d-none">
                            <i class="icon-mid bi bi-trash"></i> Xóa
                        </button>
                    @endif
                </div>
                @if (!empty(Auth::user()->can(App\Models\User::READ_USERS)))
                    <div class="card-body">
                        <form method="post" id="batch-form">
                            <div class="table-resposive">
                                <table class="table table-hover table-borderless" id="data-table">
                                    <thead>
                                        <tr>
                                            <th>
                                                @if (!empty(Auth::user()->hasAnyPermission(App\Models\User::DELETE_USERS)))
                                                <input type="checkbox" id="all-choices" class="form-check-input">
                                                @endif
                                            </th>
                                            <th>ID</th>
                                            <th>Tên</th>
                                            <th>Điện thoại</th>
                                            <th>Vai trò</th>
                                            <th>Đăng nhập cuối</th>
                                            <th>Trạng thái</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </form>
                    </div>
                @else
                    @include('includes.access_denied')
                @endif
            </div>
        </section>
    </div>


    <script src="{{ asset('admin/vendors/apexcharts/apexcharts.js') }}"></script>
    <!-- <script src="{{ asset('admin/js/pages/dashboard.js') }}"></script> -->
@endsection

@push('scripts')
    <script>
        config.routes.load = `{{ route('admin.user') }}`
        config.routes.remove = `{{ route('admin.user.remove') }}`
        $(document).ready(function() {
            const table = $('#data-table').DataTable({
                bStateSave: true,
                stateSave: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: config.routes.load,
                    error: (err) => {
                        dataTableErrorProcess(err)
                    }
                },
                columns: [
                    config.dataTable.columns.checkboxes,
                    config.dataTable.columns.id,
                    config.dataTable.columns.name,
                    config.dataTable.columns.phone,
                    config.dataTable.columns.roles,
                    config.dataTable.columns.last_login_at,
                    config.dataTable.columns.status,
                    config.dataTable.columns.action
                ],
                language: config.dataTable.lang,
                pageLength: 150,
                aLengthMenu: config.dataTable.length,
                columnDefs: config.dataTable.columnDefines,
                order: [
                    [1, 'DESC']
                ]
            })
        })
    </script>
@endpush
