@extends('admin.layouts.app')
@section('title') {{ $pageName }} @endsection
@section('content')
<div class="container-fluid">
    <h2 class='mb-5'>{{ $pageName }}</h2>
    <div class="row justify-content-center">
        <div class="col-12">
            @if (session('response') && session('response')['success'])
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
            <div class="card mb-4">
                <form id="language-form" action="{{ route('admin.language.update') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row mb-3 border-bottom">
                            <div class="col-4">
                                <button type="button" class="btn btn-primary btn-sm btn-add">{{__('Add')}}</button>
                                <button type="button" class="btn btn-primary btn-sm btn-edit">{{__('Edit')}}</button>
                                <button type="submit" class="btn btn-primary btn-sm btn-save d-none">{{__('Save')}}</button>
                            </div>
                            <div class="col-4">
                                <h3>Tiếng Việt</h3>
                            </div>
                            <div class="col-4">
                                <h3>Tiếng Anh</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4" id="label-lang">
                                @foreach($en[0] as $label => $value)
                                <label class="text-nowrap overflow-hidden pb-0 col-12 col-form-label">{{$label}}</label>
                                @endforeach
                            </div>
                            <div class="col-4" id="first-lang">
                                @foreach($vn[0] as $label => $value)
                                <input type="text" readonly name="vn[label][{{$label}}]" class="form-control-plaintext" value="{{ $value }}">
                                @endforeach
                            </div>
                            <div class="col-4" id="second-lang">
                                @foreach($en[0] as $label => $value)
                                <input type="text" readonly name="en[label][{{$label}}]" class="form-control-plaintext" value="{{ $value }}">
                                @endforeach
                            </div>
                        </div>
                        <div class="row border-top">
                            <div class="col-4">
                                @foreach($vn[1] as $fileName => $fileValue)
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
                            <div class="col-4">
                                @foreach($vn[1] as $fileName => $fileValue)
                                @foreach($fileValue as $label => $value)
                                @if(is_array($value))
                                @foreach($value as $label2 => $value2)
                                @if(is_array($value2))
                                @foreach($value2 as $label3 => $value3)
                                @if(is_array($value3))
                                @foreach($value3 as $label4 => $value4)
                                @if(is_array($value4))
                                @foreach($value4 as $label5 => $value5)
                                <input type="text" class="form-control-plaintext" readonly name="vn[message][{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}][{{$label4}}][{{$label5}}]" value="{{$value5}}">
                                @endforeach
                                @else
                                <input type="text" class="form-control-plaintext" readonly name="vn[message][{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}][{{$label4}}]" value="{{$value4}}">
                                @endif
                                @endforeach
                                @else
                                <input type="text" class="form-control-plaintext" readonly name="vn[message][{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}]" value="{{$value3}}">
                                @endif
                                @endforeach
                                @else
                                <input type="text" class="form-control-plaintext" readonly name="vn[message][{{$fileName}}][{{$label}}][{{$label2}}]" value="{{$value2}}">
                                @endif
                                @endforeach
                                @else
                                <input type="text" class="form-control-plaintext" readonly name="vn[message][{{$fileName}}][{{$label}}]" value="{{$value}}">
                                @endif
                                @endforeach
                                @endforeach
                            </div>
                            <div class="col-4">
                                @foreach($en[1] as $fileName => $fileValue)
                                @foreach($fileValue as $label => $value)
                                @if(is_array($value))
                                @foreach($value as $label2 => $value2)
                                @if(is_array($value2))
                                @foreach($value2 as $label3 => $value3)
                                @if(is_array($value3))
                                @foreach($value3 as $label4 => $value4)
                                @if(is_array($value4))
                                @foreach($value4 as $label5 => $value5)
                                <input type="text" class="form-control-plaintext" readonly name="en[message][{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}][{{$label4}}][{{$label5}}]" value="{{$value5}}">
                                @endforeach
                                @else
                                <input type="text" class="form-control-plaintext" readonly name="en[message][{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}][{{$label4}}]" value="{{$value4}}">
                                @endif
                                @endforeach
                                @else
                                <input type="text" class="form-control-plaintext" readonly name="en[message][{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}]" value="{{$value3}}">
                                @endif
                                @endforeach
                                @else
                                <input type="text" class="form-control-plaintext" readonly name="en[message][{{$fileName}}][{{$label}}][{{$label2}}]" value="{{$value2}}">
                                @endif
                                @endforeach
                                @else
                                <input type="text" class="form-control-plaintext" readonly name="en[message][{{$fileName}}][{{$label}}]" value="{{$value}}">
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
                firstLang = `<input type="text" class="form-control" id="first-lang-${index}" placeholder="tiếng Việt">`,
                secondLang = `<input type="text" class="form-control" id="second-lang-${index}" placeholder="tiếng Anh">`;
            $('#label-lang').prepend(label);
            $('#first-lang').prepend(firstLang);
            $('#second-lang').prepend(secondLang);
            index++;
        })
    })

    $(document).on('keydown change', '.label-lang', function () {
        index = $(this).attr('data-index');
        $(`#first-lang-${index}`).attr('name', `vn[label][${$(this).val()}]`).attr('placeholder', 'tiếng Việt của ' + $(this).val());
        $(`#second-lang-${index}`).attr('name', `en[label][${$(this).val()}]`).attr('placeholder', 'tiếng Anh của ' + $(this).val());
    })
</script>
@endpush