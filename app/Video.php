<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\TrateRulesMessage;

class Video extends Model
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
    
     public function validationCheck($data)
    {
         
         Validator::make(
            $data, 
            $this->rulesVideoData() ,
            $this->messagesData()
              )->validate(); 
    }
    
    public function saveVideo($data)
    {
        $parseUrlArray = parse_url($data['url']);
        $urlVideo = explode('=', $parseUrlArray['query']);

        $this->url = $urlVideo['1'];
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->user_id = Auth::id();
        $this->save();

        $idNewVideo = $this->id;
        $categories = $data['choose-category'];
        
        $relation = Video::find($idNewVideo);
        $relation->subCategories()->attach($categories);
    }
}
