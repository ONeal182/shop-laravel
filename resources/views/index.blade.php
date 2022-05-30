@extends('layouts.master');
@section('title', 'Главная');
@section('content');
    <div class="starter-template">
        @if (session()->has('success'))
            <p class="alert alert-success">{{session()->get('success')}}</p>
        @endif
        
        <h1>Все товары</h1>

        <div class="row">
            @foreach ($prudcts as $product)
                @include('layouts.card', ['product' => $product])
            @endforeach


        </div>
    </div>
@endsection
