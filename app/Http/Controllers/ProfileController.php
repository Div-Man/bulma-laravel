<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;



use App\Category;
use App\Image;
use App\SubCategory;
use App\Tag;
use App\Comment;
use App\User;



class ProfileController extends Controller
{
    public function __construct(User $userClass)
    {
         $this->userClass = $userClass;
    }

    public function index()
    {
        $avatar = User::find(Auth::id())->avatar_700;
        return view('/my-profile/top-menu', [
            'avatar' => $avatar,
            ]);
    }
    
    public function profileSecurity()
    {
       return view('/my-profile/profile-security');
    }
    
    public function updatePassword(Request $request)
    {
        
        //надо все данные провалидировать
        
        $data = $request->all();
        $user = User::find(Auth::id());
        $oldUserPassword = $user->password;
        
        if (Hash::check($data['old-password'], $oldUserPassword)) {
            $user->password = Hash::make($data['new-password']);
            $user->save();
            return redirect()->back()->with('updatePassword', 'Пароль изменён'); 
            
        }
        
        else {
            return redirect()->back()->with('updatePasswordError', 'Текущий пароль введён не правильно'); 
        }
        //dd($data);
        
    }
    
    public function update(Request $request)
    {
         $user = User::find(Auth::id());
         
         Storage::makeDirectory('uploads/user-avatar/id' . Auth::id());
         
         Storage::delete('uploads/user-avatar/id' .  Auth::id() . '/' . $user->avatar_150);
         Storage::delete('uploads/user-avatar/id' .  Auth::id() . '/' . $user->avatar_700);
         
         $image = $request->file('image');
            
         $img150 = \Intervention\Image\Facades\Image::make($image)->resize(150, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img700 = \Intervention\Image\Facades\Image::make($image)->resize(700, null, function ($constraint) {
            $constraint->aspectRatio();
        });
         
         $img150->save('uploads/user-avatar/id' .  Auth::id() . '/size-150-'.time() . '.jpg');
         $img700->save('uploads/user-avatar/id' .  Auth::id() . '/size-700-'.time() . '.jpg');
         
         $user->avatar_150 = 'uploads/user-avatar/id' .  Auth::id() . '/' . $img150->basename;
         $user->avatar_700 = 'uploads/user-avatar/id' .  Auth::id() . '/' . $img700->basename;
         
         $user->save();
         return redirect()->back();
        
    }
      
}
