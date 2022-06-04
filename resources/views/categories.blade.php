@extends('layouts.master');
@section('title', 'Категории');

@section('content')

    <div class="starter-template">
        @foreach ($categories as $categorie)
            <div class="panel">
                <a href="/{{ $categorie->code }}">
                    <img src="{{Storage::url($categorie->image)}}">
                    <h2>{{ $categorie->name }}</h2>
                </a>
                <p>
                    {{ $categorie->description }}
                </p>
            </div>
        @endforeach
    </div>
@endsection