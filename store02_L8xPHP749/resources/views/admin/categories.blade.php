@extends('layouts.app')

@section('title')
    Список категорий
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
    @if(session('addCategory'))
        <div class="alert alert-success" role="alert">
            Категория успешно добавлена!
        </div>
    @endif
    <h1>Добавление новой категории</h1>
    <form method="post" action="{{ route('addCategory') }}" enctype="multipart/form-data" class="mb-5">
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
            <label class="form-label">Изображение</label>
            <input type="file" name="picture" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Добавить категорию</button>
    </form>

    <h1>{{ $title }}</h1>
    <table class="table table-bordered mb-5">
        <thead>
            <tr>
                <th>#</th>
                <th>Наименование</th>
                <th>Описание</th>
                <th>Изображение</th>
            </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>{{ $category->picture }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
