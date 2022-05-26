@extends('master');
@section('title', 'Товар ');

@section('content')

    <div class="starter-template">
        <h1>{{ $product->name }}</h1>
        <p>Цена: <b>{{ $product->price }} руб.</b></p>
        <img src="/storage/products/iphone_x.jpg">
        <p>{{ $product->description }}</p>
        <a class="btn btn-success" href="/basket/1/add">Добавить в корзину</a>
    </div>
@endsection