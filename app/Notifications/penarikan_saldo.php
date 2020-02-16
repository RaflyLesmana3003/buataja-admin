<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class penarikan_saldo extends Notification
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
                    ->subject('permintaan pencairan saldo')
                   ->greeting('')  
                    ->line(new HtmlString('Hai '.$this->data['namacreator'].', permintaan pencairan saldo pada '.$this->data['date'].' sedang diproses <br>'))
                    ->line(new HtmlString('Permintaan Pencairan: Rp.'.$this->data['jumlah'].' <br>'))
                    ->line(new HtmlString('Biaya Layanan: Rp.'.$this->data['fee'].' <br>'))
                    ->line(new HtmlString('Nominal Pencairan: <strong> Rp.'.$this->data['total'].'</strong> <br>')) 
                    ->action('buataja.id', url('/'));

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
