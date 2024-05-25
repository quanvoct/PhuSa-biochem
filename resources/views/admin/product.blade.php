@extends('admin.layouts.app')
@section('title')
    {{ $pageName }}
@endsection
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h5 class="text-uppercase">{{ old('name') != null ? old('name') : (isset($product) ? $product->name : $pageName) }}</h5>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav class="breadcrumb-header float-start float-lg-end" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Bảng tin</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.product') }}">Sản phẩm</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $pageName }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        @if (session('response') && session('response')['status'] == 'success')
            <div class="alert alert-primary alert-dismissible fade show text-white" role="alert">
                <i class="fas fa-check"></i>
                {!! session('response')['msg'] !!}
                <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close">
                </button>
            </div>
        @elseif (session('response'))
            <div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
                <i class="fa-solid fa-xmark"></i>
                {!! session('response')['msg'] !!}
                <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close">
                </button>
            </div>
        @elseif ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
                    <i class="fa-solid fa-xmark"></i>
                    {{ $error }}
                    <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close">
                    </button>
                </div>
            @endforeach
        @endif
        <form id="product-form" action="{{ route('admin.product.save') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-12 col-lg-9 mx-auto">
                    <section class="section">
                        @if (!empty(Auth::user()->hasAnyPermission(App\Models\User::UPDATE_PRODUCT, App\Models\User::CREATE_PRODUCT)))
                            <div class="card card-body">
                                <div class="form-group">
                                    <label class="form-label" for="product-name">Tên sản phẩm</label>
                                    <input class="form-control @error('name') is-invalid @enderror" id="product-name" name="name" type="text" value="{{ old('name') != null ? old('name') : (isset($product) ? $product->name : '') }}">
                                    @error('name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="product-excerpt">Mô tả ngắn</label>
                                    <textarea class="form-control @error('excerpt') is-invalid @enderror" id="product-excerpt" name="excerpt" rows="3">{{ old('excerpt') != null ? old('excerpt') : (isset($product) ? $product->excerpt : '') }}</textarea>
                                    @error('excerpt')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="product-description">Nội dung sản phẩm</label>
                                    @error('description')
                                        <span class="invalid-feedback d-inline-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <textarea class="form-control summernote @error('description') is-invalid @enderror" id="product-description" name="description" rows="100">{{ old('description') != null ? old('description') : (isset($product) ? $product->description : '') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="product-images">Gallery ảnh sản phẩm</label>
                                    <input id="product-images" name="gallery" type="hidden" value="{{ old('gallery') != null ? old('gallery') : (isset($product) ? $product->gallery : '') }}">
                                    <div class="row gallery align-items-center pt-2">
                                    </div>
                                </div>
                            </div>
                            @if (isset($product))
                                <div class="card">
                                    <div class="card-body">
                                        <div class="col-12 col-md-6">
                                            @if (Auth::user()->can(App\Models\User::CREATE_VARIABLE))
                                                <a class="btn btn-primary mb-3 block btn-create-variable">
                                                    <i class="bi bi-plus-circle"></i>
                                                    Thêm
                                                </a>
                                            @endif
                                        </div>
                                        <table class="table table-hover" id="data-table">
                                            <thead>
                                                <tr>
                                                    <th class="text-start">Mã biến thể</th>
                                                    <th class="text-start">Tên biến thể</th>
                                                    <th class="text-end">Giá</th>
                                                    <th class="text-start">Trạng thái</th>
                                                    <th class="text-center"></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        @else
                            @include('admin.includes.access_denied')
                        @endif
                    </section>
                </div>
                <div class="col-12 col-lg-3 mx-auto">
                    <!-- Publish card -->
                    <div class="card card-body mb-3">
                        <h6 class="mb-0">Đăng bài</h6>
                        <hr class="horizontal dark">
                        <div class="form-group">
                            <label class="form-label mt-1" for="product-status">Trạng thái</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="product-status" name="status">
                                <option value="0" {{ (isset($product) && $product->status == 0) || old('status') == 0 ? 'selected' : '' }}>
                                    Bị khóa</option>
                                <option value="1" {{ (isset($product) && $product->status == 1) || old('status') == 1 ? 'selected' : '' }}>
                                    Hiển thị</option>
                                <option value="3" {{ (isset($product) && $product->status == 3) || old('status') == '3' ? 'selected' : '' }}>
                                    Nổi bật</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="product-date">Thời gian</label>
                            <div class="input-group">
                                <input class="form-control @error('date') is-invalid @enderror" id="product-date" name="date" type="date"
                                    value="{{ old('date') != null ? old('date') : (isset($product) ? $product->createdDate() : Carbon\Carbon::now()->format('Y-m-d')) }}" aria-label="Ngày">
                                <input class="form-control @error('time') is-invalid @enderror" id="product-time" name="time" type="time"
                                    value="{{ old('time') != null ? old('time') : (isset($product) ? $product->createdTime() : Carbon\Carbon::now()->format('H:i:s')) }}" aria-label="Giờ">
                            </div>
                        </div>
                        @error('date')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @error('time')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input id="product-deleted_at" name="deleted_at" type="hidden" value="{{ isset($product) ? $product->deleted_at : '' }}">
                        <input id="product-id" name="id" type="hidden" value="{{ isset($product) ? ($product->revision ? $product->revision : $product->id) : '' }}">
                        <button class="btn btn-info" type="submit">{{ isset($product) ? 'Cập nhật' : 'Đăng sản phẩm' }}</button>
                    </div>
                    <!-- END Publish card -->
                    <!-- Catalog card -->
                    <div class="card card-body mb-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="form-label mb-0">Danh mục</h6>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn btn-outline-primary btn-sm btn-refresh-catalogue">
                                    <i class="bi bi-arrow-repeat"></i> Refresh
                                </a>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <div class="catalogue-select">
                            <ul class="list-group">
                                @include('admin.includes.catalogue_recursion', [
                                    'catalogues' => $catalogues,
                                    'product' => isset($product) ? $product : null,
                                ])
                            </ul>
                        </div>
                        @error('catalogues')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <a class="btn btn-sm btn-link mt-3 btn-create-catalogue">Thêm danh mục</a>
                    </div>
                    <!-- END Catalog card -->
                    <!-- Setting product -->
                    <div class="card card-body mb-3">
                        <h6 class="mb-0">Thiết lập sản phẩm</h6>
                        <hr class="horizontal dark">
                        <div class="form-group">
                            <label class="form-label mt-1" for="product-sku">Mã sản phẩm (SKU)</label>
                            <input class="form-control @error('sku') is-invalid @enderror" id="product-sku" name="sku" type="text" value="{{ old('sku') != null ? old('sku') : (isset($product) ? $product->sku : '') }}"
                                placeholder="Mã sản phẩm" autocomplete="off">
                            @error('sku')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label mt-1" for="product-unit">Đơn vị tính</label>
                            <input class="form-control @error('unit') is-invalid @enderror" id="product-unit" name="unit" type="text" value="{{ old('unit') != null ? old('unit') : (isset($product) ? $product->unit : '') }}"
                                placeholder="Đơn vị tính" autocomplete="off">
                            @error('unit')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label mt-1" for="product-keyword">Các từ khoá</label>
                            <input class="form-control @error('keyword') is-invalid @enderror" id="product-keyword" name="keyword" type="text" value="{{ old('keyword') != null ? old('keyword') : (isset($product) ? $product->keyword : '') }}"
                                placeholder="Từ khoá hỗ trợ tối ưu tìm kiếm" autocomplete="off">
                            @error('keyword')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="keyword-list"></div>
                        </div>
                        <div class="form-group mt-3">
                            <div class="form-check">
                                <input class="form-check-input form-check-info form-check-glow @error('allow_review') is-invalid @enderror" id="product-allow_review" name="allow_review" type="checkbox"
                                    {{ (isset($product) && $product->allow_review) || old('allow_review') ? 'checked' : '' }} autocomplete="off">
                                <label class="form-check-label" for="product-allow_review">Cho phép đánh giá
                                    sản phẩm</label>
                            </div>
                            @error('allow_review')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- END Setting product -->
                    <!-- Specs product -->
                    <div class="card card-body mb-3">
                        <h6 class="mb-0">Thiết lập sản phẩm</h6>
                        <hr class="horizontal dark">
                        <div id="product-specs">
                            @if (old('specs_key') !== null)
                                @foreach (old('specs_key') as $i => $key)
                                    <div class="row mb-3">
                                        <div class="col-sm-4 pe-0">
                                            <input class="form-control" id="product-specs_key" name="specs_key[]" type="text" value="{{$key}}" placeholder="Mô tả" required>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input class="form-control" id="product-specs_value[]" name="specs_value[]" value="{{old('specs_value')[$i]}}" type="text" placeholder="Thông số" autocomplete="off" required>
                                                <div class="btn btn-outline-danger btn-product-specs_remove">&#10005;</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @elseif(isset($product) && $product->specs !== null)
                                @foreach (json_decode($product->specs) as $key => $value)
                                    <div class="row mb-3">
                                        <div class="col-sm-4 pe-0">
                                            <input class="form-control" id="product-specs_key" name="specs_key[]" type="text" value="{{ $key }}" placeholder="Mô tả" required>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input class="form-control" id="product-specs_value[]" name="specs_value[]" value="{{ $value }}" type="text" placeholder="Thông số" autocomplete="off" required>
                                                <div class="btn btn-outline-danger btn-product-specs_remove">&#10005;</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        @error('specs')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <button class="btn btn-outline-primary btn-sm btn-product-specs_add" type="button">Thêm thông số</button>
                    </div>
                    <!-- END Specs product card -->
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.btn-product-specs_add').click(function() {
                $('#product-specs').append(`
                    <div class="row mb-3">
                        <div class="col-sm-4 pe-0">
                            <input class="form-control" id="product-specs_key" name="specs_key[]" type="text" placeholder="Mô tả" required>
                        </div>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input class="form-control" id="product-specs_value[]" name="specs_value[]" type="text" placeholder="Thông số" autocomplete="off" required>
                                <div class="btn btn-outline-danger btn-product-specs_remove">&#10005;</div>
                            </div>
                        </div>
                    </div>`)
            })

            $(document).on('click', '.btn-product-specs_remove', function() {
                $(this).closest('.row').remove()
            })

            @if (isset($product))
                const table = $('#data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: `{{ route('admin.variable') }}?product_id={{ $product->revision ? $product->revision : $product->id }}`,
                        error: function(err) {
                            datatableAjaxError(err)
                        }
                    },
                    columns: [{
                            data: 'sub_sku',
                            name: 'sub_sku'
                        },
                        config.dataTable.columns.name, {
                            data: 'price',
                            name: 'price',
                            className: 'text-end'
                        },
                        config.dataTable.columns.status,
                        config.dataTable.columns.action,
                    ],
                    aLengthMenu: config.dataTable.lengths,
                    language: config.dataTable.lang,
                    columnDefs: config.dataTable.columnDefines,
                    order: [
                        [1, 'DESC']
                    ],
                })
            @endif

            $(document).on('click', '.btn-create-variable', function(e) {
                e.preventDefault();
                const form = $('#variable-form')
                resetForm(form)
                form.find(`[name='status']`).prop('checked', true)
                @if (isset($product))
                    form.find(`[name='product_id']`).val(`{{ $product->revision ? $product->revision : $product->id }}`)
                @endif
                form.attr('action', `{{ route('admin.variable.create') }}`)
                form.find('.modal').modal('show')
            })

            $(document).on('click', '.btn-update-variable', function(e) {
                e.preventDefault();
                const id = $(this).attr('data-id'),
                    form = $('#variable-form');
                resetForm(form)
                $.get(`{{ route('admin.variable') }}/${id}`, function(variable) {
                    form.find('#variable-modal-label').text(variable.name)
                    form.find('[name=id]').val(variable.id)
                    form.find('[name=sub_sku]').val(variable.sub_sku)
                    form.find('[name=name]').val(variable.name)
                    form.find('[name=price]').val(variable.price)
                    form.find('[name=length]').val(variable.length)
                    form.find('[name=width]').val(variable.width)
                    form.find('[name=height]').val(variable.height)
                    form.find('[name=weight]').val(variable.weight)
                    form.find('[name=image]').val(variable.image).change()
                    form.find('[name=description]').val(variable.description)
                    form.find(`[name='status']`).prop('checked', variable.status)
                    @if (isset($product))
                        form.find(`[name='product_id']`).val(`{{ $product->revision ? $product->revision : $product->id }}`)
                    @endif
                    $.each(variable.attributes, function(index, attribute) {
                        form.find(`#variable-attribute-${attribute.id}`).prop('checked', true);
                    })
                    form.attr('action', `{{ route('admin.variable.update') }}`)
                    form.find('.modal').modal('show')
                })
            })

            viewProductImages()

            $('#product-name').keyup(function() {
                $('.head-name').text($(this).val());
            })

            $(document).on('click', '.add-gallery', function() {
                openQuickImages('product-images', false)
            })

            $('[type=submit]').click(function() {
                $(this).prop('disabled', true).html(
                        '<span class="spinner-border spinner-border-sm" id="spinner-form" role="status"></span>')
                    .parents('form').submit()
            })

            $('#product-images').change(function() {
                viewProductImages()
            })

            $('[name=keyword]').keyup(function() {
                let keywordArr = $.map($(this).val().split(','), function(keyword) {
                    return `<span class="badge bg-light-primary my-2 ms-2">${keyword}</span>`;
                });
                $(this).parents('div').find('.keyword-list').html(keywordArr.join(''));
            })

            function showAttributes(attribute) {
                let text =
                    `
            <input type="checkbox" class="btn-check attribute" name="attributes[]" value="${ attribute.id }" id="attribute-${ attribute.id }" autocomplete="off">
            <label class="btn btn-outline-primary btn-sm mb-2" for="attribute-${ attribute.id }">${ attribute.value }</label>`
                if ($('.attribute-select').find(`button[data-key='${ attribute.key }']`).length) {
                    $(`button[data-key='${ attribute.key }']`).parents('.accordion-body').find('.list-attribute').append(text)
                } else {
                    $('.attribute-select').prepend(`
            <div class="accordion-item">
                <h2 class="accordion-header" id="attribute-heading-${ attribute.id }">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#attributes-${ attribute.id }" aria-expanded="true" aria-controls="attributes-${ attribute.id }">
                        ${attribute.key}
                    </button>
                </h2>
                <div id="attributes-${ attribute.id }" class="accordion-collapse collapse show" aria-labelledby="attributes-heading-${ attribute.id }">
                    <div class="accordion-body">
                        <div class="list-attribute">
                            ${text}
                        </div>
                        <button type="button" class="btn btn-primary btn-sm mb-2 ms-1 pt-0 btn-create-attribute" data-key="${ attribute.key }"><i class="bi bi-plus"></i></button>
                    </div>
                </div>
            </div>
            `)
                }
            }

            function viewProductImages() {
                let text = ''
                $.each($('#product-images').val().split('|'), function(index, image) {
                    if (!image == '') {
                        text += `
                    <div class="col-4 col-md-3 col-lg-2">
                        <div class="card card-image text-bg-dark mb-2">
                            <button type="button" class="btn-close btn-remove-images" data-index="${index}" aria-label="Close"></button>
                            <div class="ratio ratio-1x1">
                                <img src="{{ asset(env('FILE_STORAGE', '/storage')) }}/${image}" class="card-img img-gallery thumb cursor-pointer">
                            </div>
                        </div>
                    </div>`
                    } else {
                        text += `
                    <div class="col-4 col-md-3 col-lg-2">
                        <div class="card text-primary add-gallery object-fit-cover ratio ratio-1x1 mb-2">
                            <i class="bi bi-plus"></i>
                        </div>
                    </div>`
                    }
                })
                $('.row.gallery').html(text)
            }
        })
    </script>
@endpush
