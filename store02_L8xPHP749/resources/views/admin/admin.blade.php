@extends('layouts.app')

@section('title')
    Страница администратора
@endsection

@section('content')
    <a href="{{ route('adminUsers') }}">Список пользователей</a>
    <a href="{{ route('adminProducts') }}">Список продуктов</a>
    <a href="{{ route('adminCategories') }}">Список категорий</a>
@endsection
