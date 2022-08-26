<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeaveNotification extends Notification
{
    use Queueable;
    private $leaveSetting;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($leaveSetting)
    {
        //
        $this->leaveSetting=$leaveSetting;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)

                ->line($this->leaveSetting['body'])
                ->action($this->leaveSetting['leaveText'], $this->leaveSetting['leaveUrl'])
                ->line($this->leaveSetting['thanks']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
