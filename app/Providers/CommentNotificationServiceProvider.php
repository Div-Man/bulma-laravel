<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\User;
use App\Http\Controllers\CommentController;
use App\Comment;
use Illuminate\Support\Facades\Auth;




class CommentNotificationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
        view()->composer('layouts.app', function ($view) {
            if(Auth::check()) {
                $notificationsCount = CommentController::countNotification();
                $view->with('notificationsCount', $notificationsCount);
            }
            else {
                $view->with('notificationsCount', 0);
            }
          

            //если убрать статику
            
            //$comment = new Comment;
            //$aaa = new CommentController($comment);
            //$notificationsCount = $aaa->readNotification();
        });
        
        
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
