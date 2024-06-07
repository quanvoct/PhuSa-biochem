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
                            <li class="breadcrumb-item"><a href="{{ route('admin.post') }}">{{ __('Posts') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $pageName }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @if (session('response') && session('response')['status'] == 'success')
        <div class="alert alert-success alert-dismissible fade show text-white" role="alert">
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
    @if (!empty(Auth::user()->can(App\Models\User::CREATE_POST)))
        <div class="page-content mb-3">
            <form id="post-form" action="{{ route('admin.post.save') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-9 mx-auto">
                        <div class="card card-body mb-0">
                            <div class="form-group">
                                <label class="form-label" for="post-title">{{ __('Title') }}</label>
                                <input class="form-control @error('title') is-invalid @enderror" id="post-title" name="title" type="text" value="{{ old('title') != null ? old('title') : (isset($post) ? $post->title : '') }}">
                                @error('title')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="post-excerpt">{{ __('Post excerpt') }}</label>
                                <textarea class="form-control @error('excerpt') is-invalid @enderror" id="post-excerpt" name="excerpt" rows="3">{{ old('excerpt') != null ? old('excerpt') : (isset($post) ? $post->excerpt : '') }}</textarea>
                                @error('excerpt')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="post-content">{{ __('Post content') }}</label>
                                @error('content')
                                    <span class="invalid-feedback d-inline-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <textarea class="form-control summernote @error('content') is-invalid @enderror" id="post-content" name="content" rows="100">{{ old('content') != null ? old('content') : (isset($post) ? $post->content : '') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3 mx-auto">
                        <!-- Publish card -->
                        <div class="card card-body mb-3">
                            <h6 class="mb-0">{{ __('Post meta') }}</h6>
                            <hr class="horizontal dark">
                            <div class="form-group">
                                <label class="form-label mt-1" for="post-status">{{ __('Status') }}</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="post-status" name="status">
                                    <option value="1" {{ (isset($post) && $post->status == 1) || old('status') === '1' ? 'selected' : '' }}>
                                        {{ __('Published') }}</option>
                                    <option value="2" {{ (isset($post) && $post->status == 2) || old('status') === '2' ? 'selected' : '' }}>
                                        {{ __('Featured') }}</option>
                                    <option value="0" {{ (isset($post) && $post->status == 0) || old('status') === '0' ? 'selected' : '' }}>
                                        {{ __('Hidden') }}</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="post-date">{{ __('Date time') }}</label>
                                <div class="input-group">
                                    <input class="form-control @error('date') is-invalid @enderror" id="post-date" name="date" type="date"
                                        value="{{ old('date') != null ? old('date') : (isset($post) ? $post->createdDate() : Carbon\Carbon::now()->format('Y-m-d')) }}" aria-label="{{ __('Date') }}">
                                    <input class="form-control @error('time') is-invalid @enderror" id="post-time" name="time" type="time"
                                        value="{{ old('time') != null ? old('time') : (isset($post) ? $post->createdTime() : Carbon\Carbon::now()->format('H:i:s')) }}" aria-label="{{ __('Time') }}">
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
                            <input id="post-deleted_at" name="deleted_at" type="hidden" value="{{ isset($post) ? $post->deleted_at : '' }}">
                            <input id="post-id" name="id" type="hidden" value="{{ isset($post) ? ($post->revision ? $post->revision : $post->id) : '' }}">
                            <button class="btn btn-primary" type="submit">{{ isset($post) ? __('Update') : __('Publish') }}</button>
                        </div>
                        <!-- END Publish card -->
                        <!-- Language card -->
                        <div class="card card-body mb-3">
                            <h6 class="mb-0">{{ __('Languages') }}</h6>
                            <hr class="horizontal dark">
                            <div class="form-group mb-4">
                                <select class="form-select" id="post-language_id" name="language_id[]" required>
                                    <option selected disabled hidden>{{ __('Choose post display language') }}</option>
                                    @foreach (App\Models\Language::all() as $language)
                                        <option value="{{ $language->id }}" {{ isset($post) && $post->languages->count() && $post->language->id == $language->id ? 'selected' : '' }}>{{ $language->name }}</option>
                                    @endforeach
                                </select>
                                @error('language')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @if (isset($post) && $post->language)
                                @php $languages = App\Models\Language::where('id', '!=', $post->language->id)->get() @endphp
                                @foreach ($languages as $index => $language)
                                    <div class="card mb-0 link-language">
                                        <div class="form-group">
                                            <label class="form-label" for="post-{{ $index }}">{{ $language->name }}</label>
                                            <select class="form-select @error('translate_id') is-invalid @enderror select2" id="post-{{ $index }}" name="translate_id[]"
                                                data-ajax--url="{{ route('admin.post', ['key' => 'find']) }}?link_language_id={{ $language->id }}&language_id={{ $post->language->id }}" data-placeholder="{{ __('Choose a post') }}">
                                                @php
                                                    $translation = $post->post_translations
                                                        ->where('post_id', $post->id)
                                                        ->where('language_id', $language->id)
                                                        ->first();
                                                    if ($translation) {
                                                        $translate = App\Models\Post::find($translation->translate_id);
                                                        echo '<option value="' . $translate->id . '">' . $translate->title . '</option>';
                                                    }
                                                @endphp
                                            </select>
                                            <input name="language_id[]" type="hidden" value="{{ $language->id }}">
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <!-- END Language card -->
                        <!-- Catalog card -->
                        <div class="card card-body mb-3">
                            <h6 class="mb-0">{{ __('Category') }}</h6>
                            <hr class="horizontal dark">
                            <div class="category-select">
                                <ul class="list-group">
                                    @foreach ($categories as $key => $category)
                                        <li class="list-group-item border border-0" id="category-group-{{ $category->id }}">
                                            <input class="form-check-input me-1 @error('category') is-invalid @enderror" id="category-{{ $category->id }}" name="category_id" type="radio" value="{{ $category->id }}"
                                                {{ (isset($post) && $post->category->pluck('id')->contains($category->id)) || collect(old('categories'))->contains($category->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="category-{{ $category->id }}">{{ __($category->name) }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            @error('categories')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <a class="btn btn-sm btn-link mt-3 btn-create-category">{{ __('Add category') }}</a>
                        </div>
                        <!-- END Catalog card -->
                        <!-- Image card -->
                        <div class="card card-body mb-3">
                            <h6 class="mb-0">{{ __('Featured image') }}</h6>
                            <hr class="horizontal dark my-3">
                            <label class="form-label select-image" for="post-image">
                                <div class="ratio ratio-1x1">
                                    <img class="img-fluid rounded-4 object-fit-cover" src="{{ isset($post) ? $post->imageUrl : asset('admin/images/placeholder.webp') }}" alt="{{ __('Featured image') }}">
                                </div>
                            </label>
                            <input class="hidden-image" id="post-image" name="image" type="hidden" value="{{ old('image') != null ? old('image') : (isset($post) ? $post->image : '') }}">
                            <button class="btn btn-outline-primary btn-remove-image d-none" type="button">{{ __('Remove') }}</button>
                            @error('image')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- END Image card -->
                    </div>
                </div>
            </form>
        </div>
    @else
        @include('admin.includes.access_denied')
    @endif
@endsection

@push('scripts')
    @if (isset($post) && $post->language)
        <script type="text/javascript">
            $('#post-language_id').change(function() {
                $('.card.link-language').remove()
            })
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $(`select.select2`).select2(config.select2);
            $('input.select2-search__field').removeAttr('style')
            $('#post-form').find('[type=submit]').click(function(e) {
                e.preventDefault()
                $("select[name='translate_id[]']").each(function() {
                    if ($(this).val() === null) {
                        $(this).parents('.card.link-language').remove();
                    }
                });
                $(this).html('<span class="spinner-border spinner-border-sm" id="spinner-form" role="status"></span>').parents('form').submit()
            })
        })
    </script>
@endpush
