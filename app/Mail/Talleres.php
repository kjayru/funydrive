<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Workshoporder;

class Talleres extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($socio)
    {
       
        $this->socio = $socio;
      
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       
        return $this->view('mails.talleres')
                    ->with([
                        'nombre' => $this->socio->name,
                        'taller' => "TALLER DEMO",
                    ]);
    }
}
