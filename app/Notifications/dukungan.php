<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class dukungan extends Notification
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
                ->subject('Selamat')
                ->greeting('hi! '.$this->data['creatorname'].' selamat ya!!')
                ->line('fans kamu yang bernama :')
                ->line(new HtmlString('<h1 style="color:#E7513B;"><strong><center> '.$this->data['username'].'</center></strong></h1>'))
                ->line('telah mendukung kamu,')
                ->line(new HtmlString('dengan membeli paket <strong style="color:#E7513B;">'.$this->data['paket'].'</strong> milikmu.'))
                ->action('buataja.id', url('/'));
                // ->line(new HtmlString('The <strong>introduction</strong> to the notification.'))
                // ->line('The <strong>introduction</strong> to the notification.')
                // ->line(new HtmlString('Due Date: <strong>' . $this->data['paket'].'</strong>'))
                // ->line('Due Date: <strong>' . $this->data['paket'].'</strong>')
                // ->action('Notification Action', url('/'));
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
