<?php

namespace App\Notifications;
use DB;
use App\Models\User;
use App\Models\Student;
use App\Models\Incident;
use App\Models\Personnel;
use App\Models\Sos;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SentSos extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        $latestSos = Sos::latest()->first();
        $sosUrl = route('sostableview', $latestSos);
        
        return [
            'message' => 'A student sent an SOS.',
            'sosUrl' => $sosUrl,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $latestSos = Sos::latest()->first();
        $sosUrl = route('sostableview', $latestSos);
        
        return [
            'message' => 'There is an incoming SOS.',
            'sosUrl' => $sosUrl,
        ];
    }
}
