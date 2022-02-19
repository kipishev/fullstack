<?php

namespace App\Jobs;

use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportCategoriesFromFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $file = fopen('importCategories.csv', 'r'); //открываем файл на чтение

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
    }
}
