<?php

use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Auth;
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

Artisan::command('orderTest', function () {
    $order = Order::first();
    $order->product->each(function ($product) {
        dump($product->pivot->quantity);
    });
});

Artisan::command('queryBuilder', function () {
    $data = DB::table('categories as c')
        ->select(
            'c.name',
            'c.description',
        )
        ->where('name', 'Процессоры')
        ->get();

    $data = DB::table('categories as c')
        ->select(
            'c.name',
            DB::raw('count(p.id) as product_quantity'),
            DB::raw('sum(p.price) as priceAmount')
        )
        //-join('products as p', 'c.id', 'p.category_id'); // джойним по одному полю
        ->leftJoin('products as p', function ($join) {
            $join->on('c.id', 'p.category_id'); // джойним по нескольким полям или какие-то определенные поля, далее можно использовать ->where
        })
        ->groupBy('c.id')
        ->get();

    DB::table('categories')
        ->orderBy('id')
        ->chunk(2, function ($categories) {
            dump($categories->count());
        });
});

/*Artisan::command('exportCategories', function () { // перенесли в job
    $categories = Category::get()->toArray();
    $file = fopen('exportCategories.csv', 'w');
    $columns = [
        'id',
        'name',
        'description',
        'picture',
        'created_at',
        'updated_at',
    ];
    fputcsv($file, $columns, ';');
    foreach ($categories as $category) {
        $category['name'] = iconv('utf-8', 'windows-1251//IGNORE', $category['name']); // для кириллыцы
        $category['description'] = iconv('utf-8', 'windows-1251//IGNORE', $category['description']);
        $category['picture'] = iconv('utf-8', 'windows-1251//IGNORE', $category['picture']);
        fputcsv($file, $category, ';');
    };
    fclose($file);
});*/

/*Artisan::command('ImportCategoriesFromFile', function () { // перенесли в job
    $file = fopen('categories.csv', 'r'); //открываем файл на чтение

    $i = 0;
    $insert = [];
    while ($row = fgetcsv($file, 1000, ';')) {
        //dump($row); //проверяем что все корректно выводится
         if ($i++ == 0) {
             $bom = pack('H*','EFBBBF');
             $row = preg_replace("/^$bom/", '', $row);
             $columns = $row;
             continue; //break прекращает цикл, continue прекращает текущую итерацию цикла
        }
        $data = array_combine($columns, $row);
        //dump($data); //должны получить массив с ключами name и description
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $insert[] = $data;
    }
    //dd($insert); //смотрим загрузку в БД
    Category::insert($insert);
});*/

Artisan::command('parseEKatalog', function () {
    $i = 0;
    do {
        $url = 'https://www.e-katalog.ru/ek-list.php?katalog_=189&search_=rtx+3090';

        $data = file_get_contents($url);
        //dd($data);

        $dom = new DomDocument();
        @$dom->loadHTML($data); //переводим строку в HTML документ, @ игнорирует ошибки в коде
        //dd($dom);

        $xpath = new DomXPath($dom); //позволяет делать запрос к данным, загруженным через loadHTML
        $divs = $xpath->query("//div[@class='model-short-div list-item--goods   ']"); //поиск элементов внутри других элементов
        //dd($divs->length); //проверяем, что именно 24 карточки получаем на данном этапе

        if ($i == 0) {
            try {
                $totalProductsString = $xpath->query("//span[@class='t-g-q']")[0]->nodeValue ?? false; //поиск элементов внутри других элементов
                //dd($totalProductsString->length); //проверяем, должен найтись один элемент с общим числом товаров
                //dd($totalProductsString); //выведем текстовую строку с числом

                preg_match_all('/\d+/', $totalProductsString, $matches); //можем использовать регулярные выражения
                //dd($matches[0]); //выводим из текстовой строки список чисел

                $totalProducts = (int)$matches[0][0];
                //dd($totalProducts);

                dump($totalProducts);
                $productsOnOnePage = $divs->length;
                $pages = ceil($totalProducts / $productsOnOnePage); //округляем до целого большего числа
                dump($pages);
            } catch (Exception $e) {
                $pages = 0;
            }
            $products = []; //определяем переменную для последующего заполнени
        }

        foreach ($divs as $div) {
            $a = $xpath->query("descendant::a[@class='model-short-title no-u']", $div);
            //dump($a->length); //мы должны 24 раза увидель, что получен 1 элемент из родительского элемента
            $name = $a[0]->nodeValue;
            //dump($name); //на данном этапе мы получим 24 названия товаров

            $price = 'Нет в наличии'; //срузу укажем нулевую цену, если что-то найдем, цена перезапишится

            $ranges = $xpath->query("descendant::div[@class='model-price-range']", $div); //получаем список
            if ($ranges->length == 1) {
                foreach ($ranges[0]->childNodes as $child) { //смотрим цену в каждом эелементе списка
                    if ($child->nodeName == 'a') {
                        $price = 'от ' . $child->nodeValue;
                        //dump($price); //если найдется диапазон, то выводим его
                    }
                }
            }
            $ranges = $xpath->query("descendant::div[@class='pr31 ib']", $div);
            if ($ranges->length == 1) {
                $price = $ranges[0]->nodeValue;
                //dump($price); //если найдется точная цена, то выводим ее
            }
            dump("$name: $price");
            $products[] = [
                'name' => $name,
                'price' => $price,
            ];
        }
        $i++;
    } while ($i < $pages);
    //dd($products); //проверяем что все данные выгружаются (массив с названием и ценой по каждому товару)

    $file = fopen('videocards.csv', 'w'); //открываем файл на запись
    foreach ($products as $product) {
        fputcsv($file, $product, ';');
    }
    fclose($file);
});

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
    /*Category::where('id', 2)->update([
        'name' => 'Процессоры',
    ]);*/

    Auth::loginUsingId(1); // обновление модели при тестировании обзервера
    $procs = Category::where('name', 'Процессоры')->first();
    $procs->description = 'Описание процессоров';
    $procs->save();
});

Artisan::command('deleteCategory',   function () {
    //$category = Category::find(1);
    //$category->delete();
    //Category::where('id', 1)->delete();
    //Category::whereNotNull('id')->delete();

    Auth::loginUsingId(1); // удаление категории при тестировании обзервера
    Category::find(13)->delete();
});

Artisan::command('createCategory', function () { // создание категорий при тестировании обзервера
    Auth::loginUsingId(1);
    $category = new Category([
        'name' => 'Коробки',
        'description' => 'Описание коробок',
    ]);
    $category->save();
    //dd($category);
});

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
