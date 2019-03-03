<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Carbon\Carbon;

class UloginController extends Controller {

    public function login(Request $request) {
        //https://habr.com/ru/post/320046/
        //https://toster.ru/q/70508
        
        //надо сгенерировать пароль
        
        $data = file_get_contents('http://ulogin.ru/token.php?token=' . $request->get('token') .
                '&host=' . $_SERVER['HTTP_HOST']);
        $user = json_decode($data, true);

        $userData = User::where('email', $user['email'])->get();


        if (!$userData->isEmpty()) {
            $userAuth = Auth::loginUsingId($userData->first()->id, true);
            return redirect('/my-profile');
        }

          $newUser = User::create([
          'name' => $user['network'] . $user['uid'],
          'email' => $user['email'],
          'password' => Hash::make('dima123'),
          'network' => $user['network'],
          'email_verified_at' => Carbon::now()->toDateTimeString(),
          ]);
          
          Auth::loginUsingId($newUser->id, true);
          return redirect('/my-profile');
    }

}
