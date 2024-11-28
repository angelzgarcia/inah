<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class VerificarAdminMailable extends Mailable
{
    use Queueable, SerializesModels;

    public
    $password,
    $token,
    $nombre,
    $saludo;

    /**
     * Create a new message instance.
     */
    public function __construct($password, $token, $nombre, $saludo)
    {
        $this -> password = $password;
        $this -> token = $token;
        $this -> nombre = ucfirst($nombre);
        $this -> saludo = $saludo;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'INAH | Verificación de Cuenta para la Administración del Sitio',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin.emails.emailVerificarCuenta',
        );
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
