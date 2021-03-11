<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Начинаем читать файл №1');
        if (!Storage::disk('public')->exists('categories.json')){
            $this->error('Ошибка: файл categories.json не найден');
        }
    }
}
