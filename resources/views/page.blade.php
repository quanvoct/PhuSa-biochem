@extends('layouts.app')
@section('title')
{{ $pageName }}
@endsection
@section('content')

<!-- Nội dung bài viết -->
{!! $page->content !!}

@endsection