<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscribeCakes extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function build()
    {
        $this->subject('teste do gustavo');
        $this->to('gsimonatofilho@gmail.com','gustavo');
        return $this->markdown('emails.subscribe-cake', [
            'cake' => 'bolo de morango',
            'status' => 'disponivel'
        ]);
    }
}
