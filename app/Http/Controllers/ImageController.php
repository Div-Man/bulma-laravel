<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Category;
use App\Image;
use App\SubCategory;
use App\Tag;
use App\Comment;
use App\User;



class ImageController extends Controller
{

     public function __construct(Image $imageClass) { 
        $this->imageClass = $imageClass;
      }
    
      
    public function imagesAll()
    {
       
 
        $images = Image::all();
         return view('index', [
            'images' => $images
             ]);
    }
      
    public function imagesAllCategory($id)
    {
        $images = SubCategory::findOrFail($id);    
        return view('category', [
            'images' => $images
             ]);
    }
    
    public function showImageOne($id)
    {
        
         $comments = Comment::where('post_id', $id)->get();
         $commentsCount = $comments->count();
         
        $image = Image::findOrFail($id);
         return view('show-photo', [
            'image' => $image,
             'comments' => $comments,
             'commentsCount' => $commentsCount
             ]);
    }
    
    public function create()
    {
        $subCategory = SubCategory::where('id_category', '1')->get();
        return view('images.upload', [
            'subCategory' => $subCategory
        ]);
    }
    
    public function storeImage(Request $request){
        
        //если с данными всё ок
        $this->imageClass->validationCheck($request->all());
        
        //то сохранить изображение
        $result = $this->imageClass->saveImage($request->all(), $request->file('image'));
        
        $request->session()->flash('newImage', 'Изображение добавлено');
        
        return redirect('/show/image/' .  $result);
    }
    
}
