@extends('admin.layouts.app')
@section('title') {{ $pageName }} @endsection
@section('content')
<div class="container-fluid">
    <h2 class='mb-5'>{{ $pageName }}</h2>
    <div class="row justify-content-center">
        <div class="col-12">
            @if (session('response') && session('response')['status'] == 'success')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check"></i>
                {!! session('response')['msg'] !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @elseif (session('response'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-xmark"></i>
                {!! session('response')['msg'] !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <ul class="nav nav-pills mb-3">
                @foreach (App\Models\Language::all() as $item)
                    <li class="nav-item">
                        <a class="nav-link{!! Request::path() === 'admin/language/' . $item->code ? ' active" aria-current="page' : '' !!}" href="{{ route('admin.language', ['key' => $item->code]) }}">{{ $item->name }}</a>
                    </li>
                @endforeach
                <li class="nav-item">
                    <a class="nav-link cursor-pointer" data-bs-toggle="modal" data-bs-target="#language-modal"><i class="bi bi-plus-circle"></i> Thêm ngôn ngữ</a>
                </li>
            </ul>
            <div class="card mb-4">
                <form id="language-form" action="{{ route('admin.language.update') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row mb-3 border-bottom">
                            <div class="col-6">
                                <button type="button" class="btn btn-primary btn-sm btn-add">{{__('Add')}}</button>
                                <button type="button" class="btn btn-primary btn-sm btn-edit">{{__('Edit')}}</button>
                                <button type="submit" class="btn btn-primary btn-sm btn-save d-none">{{__('Save')}}</button>
                                <input type="hidden" name="language_code" value="{{ $language->code }}">
                            </div>
                            <div class="col-6">
                                <h3>{{ $language->name }}</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6" id="label-lang">
                                @foreach($strings[0] as $label => $value)
                                <label class="text-nowrap overflow-hidden pb-0 col-12 col-form-label">{{$label}}</label>
                                @endforeach
                            </div>
                            <div class="col-6" id="string-lang">
                                @foreach($strings[0] as $label => $value)
                                <input type="text" readonly name="strings[label][{{$label}}]" class="form-control-plaintext" value="{{ $value }}">
                                @endforeach
                            </div>
                        </div>
                        <div class="row border-top">
                            <div class="col-6">
                                @foreach($strings[1] as $fileName => $fileValue)
                                @foreach($fileValue as $label => $value)
                                @if(is_array($value))
                                @foreach($value as $label2 => $value2)
                                @if(is_array($value2))
                                @foreach($value2 as $label3 => $value3)
                                @if(is_array($value3))
                                @foreach($value3 as $label4 => $value4)
                                @if(is_array($value4))
                                @foreach($value4 as $label5 => $value5)
                                <label class="text-nowrap overflow-hidden pb-0 col-12 col-form-label">{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}.{{$label4}}.{{$label5}}</label>
                                @endforeach
                                @else
                                <label class="text-nowrap overflow-hidden pb-0 col-12 col-form-label">{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}.{{$label4}}</label>
                                @endif
                                @endforeach
                                @else
                                <label class="text-nowrap overflow-hidden pb-0 col-12 col-form-label">{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}</label>
                                @endif
                                @endforeach
                                @else
                                <label class="text-nowrap overflow-hidden pb-0 col-12 col-form-label">{{$fileName}}.{{$label}}.{{$label2}}</label>
                                @endif
                                @endforeach
                                @else
                                <label class="text-nowrap overflow-hidden pb-0 col-12 col-form-label">{{$fileName}}.{{$label}}</label>
                                @endif
                                @endforeach
                                @endforeach
                            </div>
                            <div class="col-6">
                                @foreach($strings[1] as $fileName => $fileValue)
                                @foreach($fileValue as $label => $value)
                                @if(is_array($value))
                                @foreach($value as $label2 => $value2)
                                @if(is_array($value2))
                                @foreach($value2 as $label3 => $value3)
                                @if(is_array($value3))
                                @foreach($value3 as $label4 => $value4)
                                @if(is_array($value4))
                                @foreach($value4 as $label5 => $value5)
                                <input type="text" class="form-control-plaintext" readonly name="strings[message][{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}][{{$label4}}][{{$label5}}]" value="{{$value5}}">
                                @endforeach
                                @else
                                <input type="text" class="form-control-plaintext" readonly name="strings[message][{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}][{{$label4}}]" value="{{$value4}}">
                                @endif
                                @endforeach
                                @else
                                <input type="text" class="form-control-plaintext" readonly name="strings[message][{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}]" value="{{$value3}}">
                                @endif
                                @endforeach
                                @else
                                <input type="text" class="form-control-plaintext" readonly name="strings[message][{{$fileName}}][{{$label}}][{{$label2}}]" value="{{$value2}}">
                                @endif
                                @endforeach
                                @else
                                <input type="text" class="form-control-plaintext" readonly name="strings[message][{{$fileName}}][{{$label}}]" value="{{$value}}">
                                @endif
                                @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal language -->
<form action="{{ route('admin.language.create') }}" method="post">
    @csrf
    <div class="modal fade" id="language-modal" aria-labelledby="language-label">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="language-label">Thêm ngôn ngữ</h3>
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
                    <button class="btn btn-primary" type="submit">Lưu</button>
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
            $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2 mt-1" id="spinner-form" role="status"></span> {{__("Waiting")}}');
            $(this).parents('form').submit();
        })
        let index = 0;
        $('.btn-add').click(function() {
            $(this).parents('div').find('.btn-edit').addClass('d-none');
            $(this).parents('div').find('.btn-save').removeClass('d-none');
            let label = `<input type="text" class="form-control label-lang" data-index="${index}" placeholder="Nhập cụm từ cần dịch">`,
                string = `<input type="text" class="form-control" id="string-lang-${index}" placeholder="{{ $language->name }}">`
            $('#label-lang').prepend(label);
            $('#string-lang').prepend(string);
            index++;
        })
    })
</script>
@endpush