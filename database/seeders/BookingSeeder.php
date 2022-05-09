<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\User;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BookingSeeder extends Seeder
{
    public function run()
    {
        File::makeDirectory(storage_path('app/public/books'));

        $list = [
            'А-ба-ба-га-ла-ма-га',
            'Каменяр',
            'Видавництво Старого Лева',
            'Фоліо',
            'Основи',
            'Зелений пес',
            'Дух та літера',
            'Наш формат',
            'Навчальна книга «Богдан»',
            'Смолоскип',
            'Ранок',
            'Апостроф',
            'Право',
            'Махаон',
        ];

        $publishers = [];

        foreach ($list as $item) {
            $publishers[] = User::create([
                'name' => $item,
                'published' => true,
                'sort' => 0,
            ]);
        }

        $authors = Author::factory(30)->create();

        /** @var Generator $faker */
        $faker = Container::getInstance()->make(Generator::class);

        $this->command->getOutput()->progressStart(1000);

        for ($i = 0; $i <= 1000; $i++) {
            /** @var Publisher $publisher */
            $publisher = Arr::random($publishers);

            $book = Book::create([
                'title' => $faker->text(50),
                'image' => $faker->image(storage_path('app/public/books'), 100, 75, null, false),
                'description' => $faker->realText,
                'publisher_id' => $publisher->id,
            ]);

            $authorsList = Arr::random($authors->toArray(), rand(1, 4));

            foreach ($authorsList as $item) {
                $book->authors()->attach($item['id']);
            }

            $this->command->getOutput()->progressAdvance();
        }

        $this->command->getOutput()->progressFinish();
    }
}
