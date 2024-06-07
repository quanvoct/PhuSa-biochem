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
                <div class="col-12 col-md-6 order-md-2 order-first d-flex justify-content-end align-items-end">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                                    <p class="text-light-primary">{{ __('Dashboard') }}</p>
                                </a></li>
                            <li class="breadcrumb-item text-dark active" aria-current="page">{{ $pageName }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content mb-3">
        @include('admin.includes.quick_images')
    </div>
@endsection