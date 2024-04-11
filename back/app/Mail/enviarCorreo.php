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
    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Entradas Cine Alex',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content([
    //         'view' => 'mail.email',
    //         'data' => $this->data, // Pasamos los datos a la vista
    //     ]);
    // }

    public function build()
    {
        return $this->subject('Entradas Cine Alex')
                    ->view('mail.email')
                    ->with(['data' => $this->data]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
