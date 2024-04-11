<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class enviarCorreo extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
/** 
   * @return $this
*/
  

    public function build()
    {
        return $this->subject('Entradas Cine Alex')
                    ->view('mail.email')
                    ->with(['data' => $this->data]);
    }

    /**
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
