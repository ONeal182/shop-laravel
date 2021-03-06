@extends('layouts.master');
@section('title', 'Категория ' . $category->name)
@section('content')
    <div class="starter-template">
        <h1>
            {{ $category->name }}
            {{ $category->products->count() }}
        </h1>
        <p>
            {{ $category->description }}
        </p>
        <div class="row">
            @foreach ($category->products()->with('category')->get() as $product)
                @include('layouts.card', ['product' => $product])
            @endforeach
        </div>
    </div>
@endsection
