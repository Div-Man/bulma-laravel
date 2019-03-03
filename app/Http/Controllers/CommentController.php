<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use Notification;
use App\Notifications\Comments;

use App\User;

use App\Category;
use App\Image;
use App\SubCategory;
use App\Tag;
use App\Comment;

class CommentController extends Controller
{

     public function __construct(Comment $commentClass) { 
        $this->commentClass = $commentClass;
      }
    
      
    public function storeComment(Request $request){
        
        
        //надо сделать проверку на существование юзера
        
        //и что бы нельзя было отвечать на свои комменты 
        
        //если создаётся ответ на коммент
        
        //можно сделать полиморфную таблицу
        //что бы не создавать отдельную для видео
        if(!empty($request->reply_user_id)) {
            
           
             $result = $this->commentClass->saveCommentReply($request->all());
             
             
              $this->commentClass->sendNotificationReply(
                    $request->image_id, 
                    $request->user_image_id, 
                    Auth::id(), 
                    $result,
                    $request->reply_user_id
                    );
             
              
              
                $user = User::find(Auth::id());
        
      
              
        return \Response::json([
                        'comment' => $request->text, 
                        'userName' =>$user->name, 
                        'userAvatar' =>$user->avatar_150, 
            ]);
            
                 
        }
        
        //если создаётся просто коммент
        else {
            
            
            $result = $this->commentClass->saveComment($request->all());
            
            
            //что бы не присылало самому себе уведомление, если просто оставить 
            //коммент на свой пост
            if((int)$request->user_image_id == Auth::id()) {
                return redirect()->back();
            }
           
            $this->commentClass->sendNotification(
                    $request->image_id, 
                    $request->user_image_id, 
                    Auth::id(), 
                    $result
                    );
        }
        
         $user = User::find(Auth::id());
        
        
         
        return \Response::json([
                        'comment' => $request->text, 
                        'userName' =>$user->name, 
                        'userAvatar' =>$user->avatar_150, 
            ]);
          
        //return redirect()->back();
    }
    
    public function storeCommentVideo()
    {
        dd('Пока что не работает добавление комментов для видео, но наверно и не будет работать');
    }
    
   
    
    //использовал статик, что бы вызывать метод, без создания объекта
      static public function countNotification()
    {
         $user = User::find(Auth::id());
        
         $countNotifications = $user->unreadNotifications->count();
         return $countNotifications; 
    }
     
      public function readNotification()
    {        
         $user = User::find(Auth::id());
         $allData = collect();
          
         $allDataReply = collect();
         
         $aaa = $user->unreadNotifications;
         
        foreach ($user->unreadNotifications as $notification) {
            
           
            //Осторожно, при объединении коллекций, айдишники побились
            
            if($notification->type == 'App\Notifications\Comments') {
                
                $collect1 = collect(Image::find($notification->data['image_id']));
                $collect2 = collect(Comment::find($notification->data['comment_id']));
                $collect3 = collect(['name' => User::find($notification->data['user_comment_id'])->name]);
                $allData->push($collect1->merge($collect2)
                        ->merge($collect3)
                        ->merge(['id_notif' => $notification->id]));
            }
            
           

            if($notification->type == 'App\Notifications\CommentReply') {

                $collect4 = collect(Image::find($notification->data['image_id']));
                $collect5 = collect(Comment::find($notification->data['comment_id']));
                $collect6 = collect(['name' => User::find($notification->data['user_comment_id'])->name]);


                $allDataReply->push($collect4->merge($collect5)
                        ->merge($collect6)
                        ->merge(['id_notif' => $notification->id]));
            }
            
           
        }
        
       
        return view('read-notifications', [
            'allData' => $allData,
            'allDataReply' => $allDataReply
             ]);
       
    }
    
    public function markNotifRead($id)
    {
        $user = User::find(Auth::id());
        foreach ($user->unreadNotifications as $notification) {
            
            if($notification->id == $id) {
                $notification->markAsRead();
            }
        }
        return redirect()->back();
    }    
}
