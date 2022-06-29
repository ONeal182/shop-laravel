@extends('layouts.master');
@section('title', 'Товар ');

@section('content')

    <div class="starter-template">
        <h1>{{ $product->name }}</h1>
        <p>Цена: <b>{{ $product->price }} руб.</b></p>
        <img src="/storage/products/iphone_x.jpg">
        <p>{{ $product->description }}</p>
        @if ($product->isAvilable())
        <form action="{{ route('basket-add', $product) }}" method="post">
            @csrf
            @if ($product->isAvilable())
                <button type="submit" class="btn btn-primary" role="button">Добавить в корзину</button>
            @else
                <button type="submit" disabled class="btn btn-primary" role="button">Недоступен</button>
            @endif

        </form>
        @else
        Недоступен
        @endif
        
    </div>
@endsection