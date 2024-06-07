@extends('admin.layouts.app')
@section('title')
    {{ $pageName }}
@endsection
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h5 class="text-uppercase">{{ $pageName }}</h5>
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
                <div class="row">
                    <div class="col-12">
                        @if (!empty(Auth::user()->can(App\Models\User::CREATE_CATEGORY)))
                            <a class="btn btn-primary mb-3 block btn-create-category">
                                <i class="bi bi-plus-circle"></i>
                                {{ __('Add') }}
                            </a>
                        @endif
                        @if (!empty(Auth::user()->can(App\Models\User::UPDATE_CATEGORY)))
                            <button class="btn btn-primary mb-3 btn-sort ms-2" type="button">
                                <i class="bi bi-filter-left"></i>
                                {{ __('Sort') }}
                            </button>
                        @endif
                        <div class="d-inline-block process-btns d-none">
                            @if (!empty(Auth::user()->can(App\Models\User::DELETE_CATEGORIES)))
                                <a class="btn btn-danger btn-removes mb-3 ms-2" type="button">
                                    <i class="bi bi-trash"></i>
                                    {{ __('Remove') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @if (!empty(Auth::user()->can(App\Models\User::READ_CATEGORIES)))
                <div class="card-body">
                    <form class="batch-form" method="post">
                        @csrf
                        <table class="table table-hover table-striped table-bordered key-table dataTable-table" id="data-table">
                            <thead>
                                <tr>
                                    <th>
                                        <input class="form-check-input all-choices" type="checkbox">
                                    </th>
                                    <th>{{ __('Priority') }}</th>
                                    <th>ID</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Created at') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </form>
                </div>
            @else
                @include('admin.includes.access_denied')
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        config.routes.get = `{{ route('admin.category') }}`
        config.routes.sort = `{{ route('admin.category.sort') }}`
        config.routes.remove = `{{ route('admin.category.remove') }}`

        $(document).ready(function() {
            const table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: `{{ route('admin.category') }}`,
                    error: function(err) {
                        datatableAjaxError(err)
                    }
                },
                columns: [
                    config.dataTable.columns.checkboxes,
                    config.dataTable.columns.sort,
                    config.dataTable.columns.id,
                    config.dataTable.columns.name,
                    config.dataTable.columns.note,
                    config.dataTable.columns.status,
                    config.dataTable.columns.created_at,
                    config.dataTable.columns.action,
                ],
                pageLength: config.dataTable.pageLength,
                aLengthMenu: config.dataTable.lengths,
                language: config.dataTable.lang,
                columnDefs: config.dataTable.columnDefines,
                order: [
                    [1, 'ASC']
                ],
            })
        })
    </script>
@endpush
