<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscribeCakes extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $tries = 3;

    private $email;
    private $bolo;
    private $disponibilidade;

    public function __construct($email, $bolo, $disponibilidade)
    {
        $this->email = $email;
        $this->bolo = $bolo;
        $this->disponibilidade = $disponibilidade;
    }

    public function build()
    {
        $this->subject('casa de bolos');
        $this->to($this->email);
        return $this->markdown('emails.subscribe-cake', [
            'cake' => $this->bolo,
            'status' => $this->disponibilidade
        ]);
    }
}
