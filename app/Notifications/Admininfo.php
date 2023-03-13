<?php

namespace App\Notifications;

use App\Http\Controllers\admin\Lt_roomController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
use App\Models\Lt_rooms;
use App\Models\Timeslots;

class Admininfo extends Notification implements ShouldQueue
{
    use Queueable;
    public $book;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($book)
    {
        $this->book=$book;
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
                    ->line('Hello admin you have recived a request by '.User::find($this->book->user_id)->name.' for booking '.Lt_rooms::find($this->book->lt_id)->room_name.' on '.date('g:i A', strtotime(Timeslots::find($this->book->timeslots_id)->start_time)).' To '.date('g:i A', strtotime(Timeslots::find($this->book->timeslots_id)->end_time)))
                    ->action('Action ', url('/'));

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
