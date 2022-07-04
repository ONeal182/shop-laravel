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
        
        <span>Товар не доступен</span>
        @if ($errors->get('email'))
            {{!! $errors->get('email')[0] !!}}
        @endif
        <br>
        <form action="{{ route('subscription', $product) }}" method="post">
            @csrf
            <input type="email" name="email" id="email">
            <button type="submit">Отправить</button>

        </form>
        @endif
        
    </div>
@endsection