<?php

namespace App\Console\Commands;

use App\Exceptions\ValidationException;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ReadFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'read:json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Команда читатет файлы из директории Storage\App\Public и импортирует из json в базу.';
    /**
     * @var CategoryRepository
     */
    private $catRepo;
    /**
     * @var ProductRepository
     */
    private $prodRepo;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CategoryRepository $catRepo, ProductRepository $prodRepo)
    {
        parent::__construct();
        $this->catRepo = $catRepo;
        $this->prodRepo = $prodRepo;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Начинаем читать файл categories.json');
        if (!Storage::disk('public')->exists('categories.json')){
            $this->error('Ошибка: файл categories.json не найден');
        }else{
            $file = Storage::disk('public')->get('categories.json');
            $data = json_decode($file,true);
            if ($data) {
                $line = 1;
                foreach ($data as $category) {
                    try {
                        $this->catRepo->create($category);
                        $this->info("Строка {$line} прочитана успешно");
                    } catch (ValidationException $e) {
                        $this->error("Ошибка валидации, строка {$line} будет пропущена");
                    }
                    $line++;
                }
            }else{
                $this->error('Не удалось распарсить данные из файла');
            }
        }

        $this->info('Начинаем читать файл products.json');
        if (!Storage::disk('public')->exists('products.json')){
            $this->error('Ошибка: файл products.json не найден');
        }else{
            $file = Storage::disk('public')->get('products.json');
            $data = json_decode($file,true);
            if ($data) {
                $line = 1;
                foreach ($data as $product) {
                    try {
                        $createdProduct = $this->prodRepo->create(Arr::only($product,['eId','title','price']));
                        $this->info("Строка {$line} прочитана успешно");
                        try {
                            if (Arr::has($product, 'categoriesEId') or Arr::has($product, 'categoryEId')) {
                                $categories = Arr::first(Arr::only($product, ['categoryEId', 'categoriesEId']));
                                $this->warn('Добавляем связи с категориями для товара ID: ' . implode(",", $categories));
                                $createdProduct->categories()->attach($categories);
                            }
                        } catch (\Exception $e){
                            $this->warn('Не удалось установить связи!');
                        }
                    } catch (ValidationException $e) {
                        $this->error("Ошибка валидации, строка {$line} будет пропущена");
                    }

                    $line++;
                }
            }else{
                $this->error('Не удалось распарсить данные из файла');
            }
        }
        $this->info('Обработка закончена.');

    }
}
