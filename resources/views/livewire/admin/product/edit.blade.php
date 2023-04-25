<div>
    <hr>
    @foreach (localization()->getSupportedLocalesKeys() as $lang)
        <div>
            @if ($product->hasTranslation($lang))
                <div>
                    <p>
                        locale: {{ $product->translate($lang)->locale }}
                    </p>
                    <h5>Title: {{ $product->translate($lang)->title }}</h5>
                    <p>
                        <strong>Description:  </strong> {{ $product->translate($lang)->description }}
                    </p>
                </div>
            @else
                <a href="{{ route('admin.products.lang.add', [$product, $lang]) }}">
                    add {{ $lang }} language
                </a>
            @endif
            <hr>
        </div>
    @endforeach
</div>
