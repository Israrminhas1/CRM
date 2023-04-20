<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class MailNotify extends Notification
{
    use Queueable;
    private $notficationslist ;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($letter)
    {
        $this->notficationslist = $letter;
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
        $notifications = DB::table('employes')->where('notify','0')->get();
        $today = Date('Y-m-d');
        $tomail = [];
        foreach ($notifications as $notify) {
            $expDate = date('Y-m-d', strtotime('-30 days', strtotime($notify->visa_expiry_date)));

            if ($today <= $expDate) {

            $dataInfo =  "Visa Expiring Soon Of ".$notify->full_name."\n" ;
            $tomail[] = $dataInfo;
            }
        }
        return (new MailMessage)
                    ->subject('Visa Expiring Alert | '.Date('Y-m-d'))
                    ->line('Visa Expiring Soon')
                    ->action('Notifications', url('/notifications'))
                    ->line($tomail);
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
