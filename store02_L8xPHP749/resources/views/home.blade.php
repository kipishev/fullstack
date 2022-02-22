@extends('layouts.app')

@section('content')
    <categories-component
        :categories="{{ $categories }}"
        route-admin-categories="{{ route('adminCategories') }}"
        route-category="{{ route('category', '') }}"
        page-title="Список категорий!"
        test="test"
    >
    </categories-component>

    {{--<div class="row">
        @foreach($categories as $category)
        <div class="col-3">
            <div class="card mb-4" style="width: 18rem;">
                <img style="width: 200px" src="{{ asset('storage') }}/{{ $category->picture }}" class="card-img-top" alt="{{ $category->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $category->name }}</h5>
                    <p class="card-text">{{ $category->description }}</p>
                    <a href="{{ route('category', $category->id) }}" class="btn btn-primary">Перейти</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>--}}
@endsection
