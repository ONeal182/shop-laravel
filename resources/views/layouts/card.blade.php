<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="labels">
            @if ($product->isNew())
                <span class="badge badge-success">Новинка</span>
            @endif
            @if ($product->isRecomend())
                <span class="badge badge-warning">Рекомендуемые</span>
            @endif
            @if ($product->isHit())
                <span class="badge badge-danger">Хит продаж</span>
            @endif


        </div>
        <img src="{{ Storage::url($product->image) }}" alt="iPhone X 64GB">
        <div class="caption">
            <h3>{{ $product->__('name') }}</h3>
            <p>{{ $product->price }} руб.</p>
            <p>
            <form action="{{ route('basket-add', $product) }}" method="post">
                @csrf
                @if ($product->isAvilable())
                    <button type="submit" class="btn btn-primary" role="button">В корзину</button>
                @else
                    <button type="submit" disabled class="btn btn-primary" role="button">Недоступен</button>
                @endif

                {{ $product->category->name }}

                <a href="{{ route('product', [isset($category) ? $category->code : $product->category->code, $product->code]) }}"
                    class="btn btn-default" role="button">Подробнее</a>
            </form>

            </p>
        </div>
    </div>
</div>
