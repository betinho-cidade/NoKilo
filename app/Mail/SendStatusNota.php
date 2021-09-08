<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendStatusNota extends Mailable
{
    use Queueable, SerializesModels;

    public $nota;
    public $status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nota)
    {
        $this->nota = $nota;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $view = ($this->nota->status == 'A') ? 'emails.nota.alteracao_status_APR' : 'emails.nota.alteracao_status_RPV';

        return $this->from('contato@nokilo.com.br')
                //->bcc('cadastro@metaprev.com.br')
                ->subject('Nokilo - Alteração de Status da Nota Fiscal - '.strToUpper($this->nota->status_descricao))
                ->markdown($view);
    }
}
