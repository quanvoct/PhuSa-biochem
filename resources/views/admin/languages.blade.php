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
    @if (session('response') && session('response')['status'] == 'success')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check"></i>
            {!! session('response')['msg'] !!}
            <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
        </div>
    @elseif (session('response'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-xmark"></i>
            {!! session('response')['msg'] !!}
            <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
        </div>
    @endif
    <div class="page-content mb-3">
        <ul class="nav nav-pills mb-3">
            @foreach (App\Models\Language::all() as $item)
                <li class="nav-item">
                    <a class="nav-link{!! Request::path() === 'admin/language/' . $item->code ? ' active" aria-current="page' : '' !!}" href="{{ route('admin.language', ['key' => $item->code]) }}">{{ $item->name }}</a>
                </li>
            @endforeach
            <li class="nav-item">
                <a class="nav-link cursor-pointer" data-bs-toggle="modal" data-bs-target="#language-modal"><i class="bi bi-plus-circle"></i> {{ __('Add language') }}</a>
            </li>
        </ul>
        <div class="card mb-0">
            <form id="language-form" action="{{ route('admin.language.update') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row mb-3 border-bottom">
                        <div class="col-6">
                            <button class="btn btn-primary btn-sm btn-add" type="button">{{ __('Add') }}</button>
                            <button class="btn btn-primary btn-sm btn-edit" type="button">{{ __('Edit') }}</button>
                            <button class="btn btn-primary btn-sm btn-save d-none" type="submit">{{ __('Save') }}</button>
                            <input name="language_code" type="hidden" value="{{ $language->code }}">
                        </div>
                        <div class="col-6">
                            <h3>{{ $language->name }}</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6" id="label-lang">
                            @foreach ($strings[0] as $label => $value)
                                <label for="string-{{ $loop->index }}" class="text-nowrap overflow-hidden pb-0 col-12 col-form-label">{{ $label }}</label>
                            @endforeach
                        </div>
                        <div class="col-6" id="string-lang">
                            @foreach ($strings[0] as $label => $value)
                                <input id="string-{{ $loop->index }}" class="form-control-plaintext" name="strings[label][{{ $label }}]" type="text" value="{{ $value }}" readonly>
                            @endforeach
                        </div>
                    </div>
                    <div class="row border-top">
                        <div class="col-6">
                            @foreach ($strings[1] as $fileName => $fileValue)
                                @foreach ($fileValue as $label => $value)
                                    @if (is_array($value))
                                        @foreach ($value as $label2 => $value2)
                                            @if (is_array($value2))
                                                @foreach ($value2 as $label3 => $value3)
                                                    @if (is_array($value3))
                                                        @foreach ($value3 as $label4 => $value4)
                                                            @if (is_array($value4))
                                                                @foreach ($value4 as $label5 => $value5)
                                                                    <label for="file-{{$loop->index . $loop->parent->index . $loop->parent->parent->index . $loop->parent->parent->parent->index . $loop->parent->parent->parent->parent->index}}"
                                                                        class="text-nowrap overflow-hidden pb-0 col-12 col-form-label">{{ $fileName }}.{{ $label }}.{{ $label2 }}.{{ $label3 }}.{{ $label4 }}.{{ $label5 }}</label>
                                                                @endforeach
                                                            @else
                                                                <label for="file-{{$loop->index . $loop->parent->index . $loop->parent->parent->index . $loop->parent->parent->parent->index}}" class="text-nowrap overflow-hidden pb-0 col-12 col-form-label">{{ $fileName }}.{{ $label }}.{{ $label2 }}.{{ $label3 }}.{{ $label4 }}</label>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <label for="file-{{$loop->index . $loop->parent->index . $loop->parent->parent->index}}" class="text-nowrap overflow-hidden pb-0 col-12 col-form-label">{{ $fileName }}.{{ $label }}.{{ $label2 }}.{{ $label3 }}</label>
                                                    @endif
                                                @endforeach
                                            @else
                                                <label for="file-{{$loop->index . $loop->parent->index}}" class="text-nowrap overflow-hidden pb-0 col-12 col-form-label">{{ $fileName }}.{{ $label }}.{{ $label2 }}</label>
                                            @endif
                                        @endforeach
                                    @else
                                        <label for="file-{{$loop->index}}" class="text-nowrap overflow-hidden pb-0 col-12 col-form-label">{{ $fileName }}.{{ $label }}</label>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                        <div class="col-6">
                            @foreach ($strings[1] as $fileName => $fileValue)
                                @foreach ($fileValue as $label => $value)
                                    @if (is_array($value))
                                        @foreach ($value as $label2 => $value2)
                                            @if (is_array($value2))
                                                @foreach ($value2 as $label3 => $value3)
                                                    @if (is_array($value3))
                                                        @foreach ($value3 as $label4 => $value4)
                                                            @if (is_array($value4))
                                                                @foreach ($value4 as $label5 => $value5)
                                                                    <input class="form-control-plaintext" id="file-{{$loop->index . $loop->parent->index . $loop->parent->parent->index . $loop->parent->parent->parent->index . $loop->parent->parent->parent->parent->index}}"
                                                                        name="strings[message][{{ $fileName }}][{{ $label }}][{{ $label2 }}][{{ $label3 }}][{{ $label4 }}][{{ $label5 }}]" type="text"
                                                                        value="{{ $value5 }}" readonly>
                                                                @endforeach
                                                            @else
                                                                <input class="form-control-plaintext" id="file-{{$loop->index . $loop->parent->index . $loop->parent->parent->index . $loop->parent->parent->parent->index}}" name="strings[message][{{ $fileName }}][{{ $label }}][{{ $label2 }}][{{ $label3 }}][{{ $label4 }}]" type="text"
                                                                    value="{{ $value4 }}" readonly>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <input class="form-control-plaintext" id="file-{{$loop->index . $loop->parent->index . $loop->parent->parent->index}}" name="strings[message][{{ $fileName }}][{{ $label }}][{{ $label2 }}][{{ $label3 }}]" type="text" value="{{ $value3 }}"
                                                            readonly>
                                                    @endif
                                                @endforeach
                                            @else
                                                <input class="form-control-plaintext" id="file-{{$loop->index . $loop->parent->index}}" name="strings[message][{{ $fileName }}][{{ $label }}][{{ $label2 }}]" type="text" value="{{ $value2 }}" readonly>
                                            @endif
                                        @endforeach
                                    @else
                                        <input class="form-control-plaintext" id="file-{{$loop->index}}" name="strings[message][{{ $fileName }}][{{ $label }}]" type="text" value="{{ $value }}" readonly>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal language -->
    <form action="{{ route('admin.language.create') }}" method="post">
        @csrf
        <div class="modal fade" id="language-modal" aria-labelledby="language-label">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title fs-5" id="language-label">{{ __('Add language') }}</h3>
                        <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <select class="form-select" id="language-code" name="code">
                            @foreach (App\Models\Language::LANG as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer text-end">
                        <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.btn-edit').click(function() {
                $(this).parents('form').find('.form-control-plaintext').attr('readonly', false).removeClass('form-control-plaintext').addClass('form-control');
                $(this).addClass('d-none').next('button').removeClass('d-none');
                $(this).parents('div').find('.btn-add').addClass('d-none');
            })

            $('.btn-save').click(function() {
                $(this).prop('disabled', true).html(`<span class="spinner-border spinner-border-sm me-2 mt-1" id="spinner-form" role="status"></span> {{ __('Loading...') }}`);
                $(this).parents('form').submit();
            })
            let index = 0;
            $('.btn-add').click(function() {
                $(this).parents('div').find('.btn-edit').addClass('d-none');
                $(this).parents('div').find('.btn-save').removeClass('d-none');
                let label = `<input type="text" class="form-control label-lang" data-index="${index}" placeholder="{{ __('Enter the phrase to be translated') }}">`,
                    string = `<input type="text" class="form-control" id="string-lang-${index}" placeholder="{{ $language->name }}">`
                $('#label-lang').prepend(label);
                $('#string-lang').prepend(string);
                index++;
            })

            $(document).on('keydown change', '.label-lang', function() {
                index = $(this).attr('data-index');
                $(`#string-lang-${index}`).attr('name', `strings[label][${$(this).val()}]`);
            })
        })
    </script>
@endpush
