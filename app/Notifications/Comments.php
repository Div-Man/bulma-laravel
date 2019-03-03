<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class Comments extends Notification
{
    use Queueable;

    private $details;

    public function __construct($details) {
        $this->details = $details;
    }

    public function via($notifiable) {
        return ['database'];
    }

    public function toDatabase($notifiable) {
        return [
            'image_id' => $this->details['image_id'],
            'user_image_id' => $this->details['user_image_id'],
            'comment_id' => $this->details['comment_id'],
            'user_comment_id' => $this->details['user_comment_id']
        ];
    }
}
