1. git clone https://github.com/Div-Man/bulma-laravel.git
2. Скопировать файл .env из другого проекта и изменить для него данные
3. Проверить, что установлена версия PHP 7 (php -v), желательно php 7.2
4. ```composer update```

5. ```php artisan migrate```
если будет ругаться, при запуске миграций, то открыть файл

```app\Providers\CategoryServiceProvider.php```

  и закомментировать строчки

```
$category = Category::all();
View::share('category', $category);
```

  потом убрать комменты

6. ```php artisan db:seed --class=CategoriesTableSeeder```

  Готово.

Что бы не дублировать код, категории для меню загружаются в провайдере ```CategoryServiceProvider```.
Всё использовано из коробки, кроме пакета **Intervention Image**.

Для авторизации, через социальные сети, использовал **uLogin**.
