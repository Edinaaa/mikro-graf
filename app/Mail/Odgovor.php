<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use App\Models\Razgovor;
use App\Models\Poruka;


use Illuminate\Queue\SerializesModels;

class Odgovor extends Mailable
{
    use Queueable, SerializesModels;
    
    public $razgovor;
    public $poruka;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Razgovor $razgovor,Poruka  $poruka)
    {
        $this->razgovor=$razgovor;
        $this->poruka=$poruka;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       // return $this->markdown('emails.odgovor')->subject('Narudzba');
         return $this->markdown('emails.odgovor');

    }
}
