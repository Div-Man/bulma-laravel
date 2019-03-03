<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\SubCategory;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            [
                'category_name' => 'Изображения',
                'title_in_english' => 'images',
            ],
            [
                'category_name' => 'Видео',
                'title_in_english' => 'videos',
            ],
        ];
		
		Category::insert($category);
        
        $subCategory = [
            [
                'sub_category_name' => 'Автомобили',
                'id_category' => 1,
            ],
             [
                'sub_category_name' => 'Кошки',
                'id_category' => 1,
            ],
             [
                'sub_category_name' => 'Дом',
                'id_category' => 2,
            ],
             [
                'sub_category_name' => 'Транспорт',
                'id_category' => 2,
            ],
        ];
        
        SubCategory::insert($subCategory);
    }
}
