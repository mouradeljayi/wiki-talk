<?php

namespace App\Notifications;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCommentPosted extends Notification
{
    use Queueable;

    protected $user;
    protected $topic;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Topic $topic, User $user)
    {
        $this->topic = $topic;
        $this->user = $user;
    }


    public function via($notifiable)
    {
        return ['database'];
    }

    
    public function toArray($notifiable)
    {
        return [
            'topicTitle' => $this->topic->title,
            'topicSlug' => $this->topic->slug,
            'username' => $this->user->name
        ];
    }
}
