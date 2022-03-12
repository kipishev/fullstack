<?php

namespace App\Jobs;

use App\Events\Counter;
use App\Events\ExportCategoriesFinished;
use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ExportCategories implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    //public $tries = 2; //указываем количество попыток для тестирования
    public $userId;

     /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Код для VueJS
        $categories = Category::get();
        $fileName = "public/categories/exportCategories_{$this->userId}.csv";
        Storage::delete($fileName);

        $count = $categories->count();

        $categories->each(function ($category, $idx) use ($fileName, $count) {
            Storage::append($fileName, collect($category)->implode(';'));
            $percent = round((($idx + 1) / $count) * 100, 2);
            Counter::dispatch($percent);
        });

        ExportCategoriesFinished::dispatch("categories/exportCategories_{$this->userId}.csv");
        /*TODO подумать как не передавать ссылку в явном виде*/

        // Код для BLADE
        /*$categories = Category::get()->toArray();
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
        fclose($file);*/
        /*TODO настроить кодировку*/
    }
}
