<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use App\Models\Narudzba;
use App\Models\Korpa;
use Illuminate\Queue\SerializesModels;

class NarudzbaIzmjena extends Mailable
{
    use Queueable, SerializesModels;
    public $narudzba;
    public $korpa;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Narudzba $narudzba,  $korpa)
    {
        $this->narudzba=$narudzba;
        $this->korpa=$korpa;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.narudzba_izmjena')->subject('Narudzba');
    }
}
