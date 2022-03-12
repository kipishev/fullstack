@extends('layouts.app')

@section('title')
    Страница администратора
@endsection

@section('content')
    <div class="row" style="justify-content: space-between">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Список пользователей</h5>
                    <a href="{{ route('adminUsers') }}" class="btn btn-primary">Показать</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Список категорий</h5>
                    <a href="{{ route('adminCategories') }}" class="btn btn-primary">Показать</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Список продуктов</h5>
                    <a href="{{ route('adminProducts') }}" class="btn btn-primary">Показать</a>
                </div>
            </div>
        </div>
    </div>
@endsection
