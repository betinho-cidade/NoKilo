<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCadastro extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $view = 'emails.cadastro.novo_cliente';

        return $this->from('naoresponda@promonokilo.com')
                ->bcc('naoresponda@promonokilo.com')
                ->subject('PromoNokilo - Cadatro Realizado')
                ->markdown($view);
    }
}
