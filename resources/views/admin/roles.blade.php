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
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Bảng tin</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $pageName }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-12">
                    @if (!empty(Auth::user()->can(App\Models\User::CREATE_ROLE)))
                        <a class="btn btn-info mb-3 block btn-create-role">
                            <i class="bi bi-plus-circle"></i>
                            Thêm
                        </a>
                    @endif
                </div>
            </div>
            <div class="card">
                @if (!empty(Auth::user()->can(App\Models\User::READ_ROLES)))
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless" id="data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên vai trò</th>
                                        <th>Các quyền</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                @else
                    @include('admin.includes.access_denied')
                @endif
            </div>
        </section>
    </div>
@endsection

@push('scripts')
<script>
    config.routes.batchRemove = `{{ route('admin.role.remove') }}`

    $(document).ready(function() {
        const table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: `{{ route('admin.role') }}`,
                error: function(err) {
                    datatableAjaxError(err)
                }
            },
            columns: [
                config.dataTable.columns.id,
                config.dataTable.columns.name, {
                    data: 'permissions',
                    name: 'permissions',
                    searchable: false,
                    sortable: false
                },
                config.dataTable.columns.action,
            ],
            language: config.dataTable.lang
        })

        $(document).on('click', '.btn-create-role', function(e) {
            e.preventDefault();
            const form = $('#role-form')
            resetForm(form)
            form.attr('action', `{{ route('admin.role.create') }}`)
            form.find('.modal').modal('show')
        })

        $(document).on('click', '.btn-update-role', function(e) {
            e.preventDefault();
            const id = $(this).attr('data-id'),
                form = $('#role-form');
            resetForm(form)
            $.get(`{{ route('admin.role') }}/${id}`, function(role) {
                form.find('[name=name]').val(role.name)
                form.find('[name=id]').val(role.id)
                $.each(role.permissions, function(index, permission) {
                    form.find(`#permission-${permission.id}`).prop('checked', true)
                })
                form.attr('action', `{{ route('admin.role.update') }}`)
                form.find('.modal').modal('show')
            })
        })

        /**
         * Check all permission on section
         */
        $(document).on('change', '.permissions', function(e) {
            e.preventDefault();
            $(this).parents('.permission-section').find('.permission').prop('checked', $(this).prop('checked'));
        })
    })
</script>
@endpush