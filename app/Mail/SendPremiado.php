<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPremiado extends Mailable
{
    use Queueable, SerializesModels;

    public $bilhete;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($bilhete)
    {
        $this->bilhete = $bilhete;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $view = 'emails.bilhete.bilhete_premiado';

        return $this->from('naoresponda@promonokilo.com')
                ->bcc('naoresponda@promonokilo.com')
                ->subject('PromoNokilo - Número da Sorte PREMIADO')
                ->markdown($view);
    }
}
