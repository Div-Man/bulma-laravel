<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Comment;
use App\Category;
use App\Video;
use App\SubCategory;

use App\Rules\Youtube;



class VideoController extends Controller
{

     public function __construct(Video $videoClass) { 
        $this->videoClass = $videoClass;
      }
    

     public function videosAll()
    {
        
        $videos = Video::all();
        
         return view('index-video', [
            'videos' =>  $videos
             ]);
    }  
      
    public function videosAllCategory($id)
    {
        $videos = SubCategory::findOrFail($id);    
        return view('category-video', [
            'videos' => $videos
             ]);
    }
    
    public function showVideoOne($id)
    {
       
        $comments = Comment::where('post_id', $id)->get();
        $commentsCount = $comments->count();
        
        $video = Video::findOrFail($id);
   
         return view('show-video', [
            'video' => $video,
            'comments' => $comments,
            'commentsCount' => $commentsCount
             ]);
    }
    
    public function create()
    {
        $subCategory = SubCategory::where('id_category', '2')->get();
        return view('videos.upload', [
            'subCategory' => $subCategory
        ]);
    }
    
    public function storeVideo(Request $request){
        
        
         //если с данными всё ок
        $this->videoClass->validationCheck($request->all());

        //то сохранить изображение
        $this->videoClass->saveVideo($request->all());
       
        return redirect('/');
    }
    
}
