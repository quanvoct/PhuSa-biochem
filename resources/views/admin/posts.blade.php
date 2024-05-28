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
                    @if (!empty(Auth::user()->can(App\Models\User::CREATE_POST)))
                        <a class="btn btn-primary mb-3 block" href="{{ route('admin.post', ['key' => 'new']) }}">
                            <i class="bi bi-plus-circle"></i>
                            Thêm
                        </a>
                    @endif
                    <div class="d-inline-block process-btns d-none">
                        @if (!empty(Auth::user()->can(App\Models\User::DELETE_POSTS)))
                            <a class="btn btn-danger btn-removes mb-3 ms-2" type="button">
                                <i class="bi bi-trash"></i>
                                Xoá
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card">
                @if (!empty(Auth::user()->can(App\Models\User::READ_POSTS)))
                    <div class="card-body">
                        <form class="batch-form" method="post">
                            @csrf
                            <table class="table table-striped table-bordered key-table" id="data-table">
                                <thead>
                                    <tr>
                                        <th>
                                            <input class="form-check-input all-choices" type="checkbox">
                                        </th>
                                        <th>ID</th>
                                        <th>Tiêu đề</th>
                                        <th>Nội dung</th>
                                        <th>Ảnh</th>
                                        <th>Người đăng</th>
                                        <th>Danh mục</th>
                                        <th>Loại</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </form>
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
        config.routes.get = `{{ route('admin.post') }}`,
            config.routes.remove = `{{ route('admin.post.remove') }}`,
            config.routes.sort = `{{ route('admin.post.sort') }}`

        $(document).ready(function() {
            const table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: `{{ route('admin.post') }}`,
                    error: function(err) {
                        datatableAjaxError(err)
                    }
                },
                columns: [
                    config.dataTable.columns.checkboxes,
                    config.dataTable.columns.id, {
                        data: 'title',
                        name: 'title'
                    }, {
                        data: 'content',
                        name: 'content'
                    }, {
                        data: 'image',
                        name: 'image'
                    }, {
                        data: 'author',
                        name: 'author'
                    }, {
                        data: 'category',
                        name: 'category'
                    }, {
                        data: 'type',
                        name: 'type'
                    },
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
