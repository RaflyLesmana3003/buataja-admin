<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class pendukung extends Notification
{
    use Queueable;
    protected $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
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
        ->subject('pembelian berhasil')
        ->greeting('hi! selamat ya!!')
        ->line('pembelian paket :')
        ->line(new HtmlString('<h1 style="color:#E7513B;"><strong><center> '.$this->data['paket'].'</center></strong></h1>'))
        ->line('dari :')
        ->line(new HtmlString('<h1 style="color:#E7513B;"><strong><center> '.$this->data['creatorname'].'</center></strong></h1>'))
        ->line('telah berhasil.')
        ->action('buataja.id', url('/'));

        // ->line(new HtmlString('dengan membeli paket <strong style="color:#E7513B;">'.$this->data['paket'].'</strong> milikmu.'))
        
       
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
