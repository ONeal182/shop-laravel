@extends('layouts.master');
@section('title', 'Главная');
@section('content');
    <div class="starter-template">
        <h1>Все товары</h1>

        <div class="row">
            @foreach ($prudcts as $product)
                @include('layouts.card', ['product' => $product])
            @endforeach


        </div>
    </div>
@endsection
