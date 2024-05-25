    @foreach ($catalogues as $key => $catalogue)
        <li class="list-group-item border border-0 pb-0" id="catalogue-group-{{ $catalogue->id }}">
            <input class="form-check-input me-1 @error('catalogue') is-invalid @enderror" id="catalogue-{{ $catalogue->id }}" name="catalogues[]" type="checkbox" value="{{ $catalogue->id }}"
                {{ $product && $product->catalogues->pluck('id')->contains($catalogue->id) ? 'checked' : '' }}>
            <label class="form-check-label" for="catalogue-{{ $catalogue->id }}">{{ $catalogue->name }}</label>
            <ul class="list-group">
                @if (count($catalogue->children))
                    @include('admin.includes.catalogue_recursion', [
                        'catalogues' => $catalogue->children,
                        'product' => isset($product) ? $product : null,
                    ])
                @endif
            </ul>
        </li>
    @endforeach
