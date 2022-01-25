<?php

use App\Models\Category;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('massCategoriesInsert', function () {
    $categories = [
        [
            'name' => 'Видеокарты',
            'description' => 'Описание видеокарт',
            'created_at' => date('Y-m-d H:i:s'),
        ],
        [
            'name' => 'Процессоры',
            'description' => 'Описание процессоров',
            'created_at' => date('Y-m-d H:i:s'),
        ],
    ];
    Category::insert($categories);
});

Artisan::command('updateCategory', function () {
    Category::where('id', 2)->update([
        'name' => 'Процессоры',
    ]);
});

Artisan::command('deleteCategory',   function () {
    //$category = Category::find(1);
    //$category->delete();
    //Category::where('id', 1)->delete();
    Category::whereNotNull('id')->delete();
});

Artisan::command('createCategory', function () {
    $category = new Category([
        'name' => 'Видеокарты',
        'description' => 'Видеокарты которые не купить',
    ]);
    $category->save();
    dd($category);
});

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
