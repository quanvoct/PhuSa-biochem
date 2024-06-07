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
                    <nav class="breadcrumb-header float-start float-lg-end" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $pageName }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content mb-3">
        <div class="card mb-0">
            <div class="card-header">
                @if (!empty(Auth::user()->can(App\Models\User::CREATE_USER)))
                    <button class="btn btn-primary btn-create-user" type="button">
                        <i class="bi bi-plus-circle"></i> {{ __('Add') }}
                    </button>
                @endif
                <div class="d-inline-block process-btns d-none">
                @if (!empty(Auth::user()->can(App\Models\User::DELETE_USERS)))
                    <button class="btn btn-danger btn-removes" type="button">
                        <i class="icon-mid bi bi-trash"></i> {{ __('Remove') }}
                    </button>
                @endif
                </div>
            </div>
            @if (!empty(Auth::user()->can(App\Models\User::READ_USERS)))
                <div class="card-body">
                    <form class="batch-form" method="post">
                        <div class="table-resposive">
                            <table class="table table-hover" id="data-table">
                                <thead>
                                    <tr>
                                        <th>
                                            @if (!empty(Auth::user()->hasAnyPermission(App\Models\User::DELETE_USERS)))
                                                <input class="form-check-input all-choices" type="checkbox">
                                            @endif
                                        </th>
                                        <th>ID</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Phone') }}</th>
                                        <th>{{ __('Roles') }}</th>
                                        <th>{{ __('Last login at') }}</th>
                                        <th>{{ __('Status') }}</th>
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
                aLengthMenu: config.dataTable.lengths,
                columnDefs: config.dataTable.columnDefines,
                order: [
                    [1, 'DESC']
                ]
            })
        })
    </script>
@endpush
