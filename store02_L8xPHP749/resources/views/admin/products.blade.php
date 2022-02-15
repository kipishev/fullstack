@extends('layouts.app')

@section('title')
    Список продуктов
@endsection

@section('content')
    @if($errors->isNotEmpty())
        <div class="alert alert-warning" role="alert">
            @foreach($errors->all() as $error)
                {{ $error }}
                @if(!$loop->last)<br>@endif
            @endforeach
        </div>
    @endif
    @if(session('addProduct'))
        <div class="alert alert-success" role="alert">
            Продукт успешно добавлен!
        </div>
    @endif
    <h1>Добавление нового продукта</h1>
    <form method="post" action="{{ route('addProduct') }}" enctype="multipart/form-data" class="mb-5">
        @csrf
        <div class="mb-2">
            <label class="form-label">Наименование</label>
            <input name="name" class="form-control">
        </div>
        <div class="mb-2">
            <label class="form-label">Описание</label>
            <input type="text" name="description" class="form-control">
        </div>
        <div class="mb-2">
            <label class="form-label">Категория</label>
            <select class="form-control" name="category_id">
                <option disabled selected>-- Выберете категорию --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2">
            <label class="form-label">Цена</label>
            <input name="price" class="form-control">
        </div>
        <div class="mb-2">
            <label class="form-label">Изображение</label>
            <input type="file" name="picture" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Добавить продукт</button>
    </form>

    <h1>{{ $title }}</h1>
    <table class="table table-bordered mb-5">
        <thead>
        <tr>
            <th>#</th>
            <th>Наименование</th>
            <th>Описание</th>
            <th>Категория</th>
            <th>Цена</th>
            <th>Изображение</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->category_id }}</td>
                {{--TODO вывести наименование категории вместо id--}}
                <td>{{ $product->price }}</td>
                <td>{{ $product->picture }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
