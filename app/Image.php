<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\TrateRulesMessage;
use Illuminate\Support\Facades\Storage;


class Image extends Model
{
    use TrateRulesMessage;
    
    // это для метода attach
    public function subCategories()
    {
        return $this->belongsToMany(SubCategory::class);
    }
    
    
    //для того, что бы вывести юзера для изображения
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
     public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
    
    public function validationCheck($data)
    {
         Validator::make(
            $data, 
            $this->rulesData() ,
            $this->messagesData()
              )->validate(); 
    }
    
    public function saveImage($data, $image)
    {   
        Storage::makeDirectory('uploads/images/id' . Auth::id());
        
         $img700 = \Intervention\Image\Facades\Image::make($image)->resize(700, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        
         $img700->save('uploads/images/id' .  Auth::id() . '/size-700-'.time() . '.jpg');
        
         
         //это если не использовать \Intervention\Image\Facades\Image
        //$fileName = $image->store('uploads/images/id' . Auth::id());
        //$this->url = $fileName;
         
        $this->url = 'uploads/images/id' .  Auth::id() . '/' . $img700->basename;
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->user_id = Auth::id();
        $this->save();

        $idNewImage = $this->id;
        $categories = $data['choose-category'];
        
        $relation = Image::find($idNewImage);
        $relation->subCategories()->attach($categories);
        
        return $idNewImage;
    }
}
