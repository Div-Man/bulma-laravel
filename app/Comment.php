<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Notification;
use App\Notifications\Comments;
use App\Notifications\CommentReply;
use App\User;

class Comment extends Model
{
    public function childs()
    {
        return $this->hasMany('App\CommentChild');
    }
    
    public function getUserAvatar($id)
    {
        return User::find($id)->avatar_150;
    }
     public function getUserName($id)
    {
        return User::find($id)->name;
    }
    
     public function saveComment($data)
    {
        $this->text = $data['text'];
        $this->post_id = $data['image_id'];
        $this->user_id = Auth::id();
        $this->save();
        
        $idNewComment = $this->id;
        
        return $idNewComment;
    }
    
     public function saveCommentReply($data)
    {
        
         
        $this->text = $data['text'];
        $this->post_id = $data['image_id'];
        $this->user_id = Auth::id();
        $this->reply_user_id = $data['reply_user_id'];
        $this->save();
        
        

        $idNewComment = $this->id;
        
        return $idNewComment;
    }
    
     public function saveCommentVideo($data)
    {
        $this->text = $data['text'];
        $this->post_id = $data['video_id'];
        $this->user_id = Auth::id();
        $this->save();
        
        $idNewComment = $this->id;
        
        return $idNewComment;
    }
    
    public function sendNotification($idImage, $idUser, $idUserComment, $idComment)
    {
         
        //здесь будет id юзера, который создал тему
         $user = User::find($idUser);
        
         
         //user_id - тот кто ответил
         //comment_id - id коммента
        
        $details = [
            'image_id' => $idImage,
            'user_image_id' => $idUser,
            'user_comment_id' => $idUserComment,
            'comment_id' => $idComment,
        ];
        
        Notification::send($user, new Comments($details));
   
    }
    
      public function sendNotificationReply($idImage, $idUser, $idUserComment, $idComment, $reply_user_id)
    {
         
        //здесь будет id юзера, который создал тему
          //ему придёт уведомление
         $user = User::find($reply_user_id);
        
         
         //user_id - тот кто ответил
         //comment_id - id коммента
         //user_comment_id - тот кто оставил коммент, но это не точно
        
        $details = [
            'image_id' => $idImage,
            'user_image_id' => $idUser,
            'user_comment_id' => $idUserComment,
            'comment_id' => $idComment,
            'reply_user_id' => $reply_user_id
        ];
        
        Notification::send($user, new CommentReply($details));
   
    }
      
}
