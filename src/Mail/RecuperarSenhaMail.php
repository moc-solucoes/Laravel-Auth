<?php

namespace MOCSolutions\Auth\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use MOCSolutions\Auth\Models\TokenSenha;
use MOCSolutions\Auth\Models\Usuario;

class RecuperarSenhaMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Usuario
     */
    private $Usuario;
    /**
     * @var string
     */
    private $assunto;
    /**
     * @var TokenSenha
     */
    private $Token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Usuario $usuario, TokenSenha $token)
    {
        $this->Usuario = $usuario;
        $this->Token = $token;
        $this->assunto = "#{$usuario->id} - Recuperação de Senha";

        $this->subject($this->assunto);
        $this->to($this->Usuario->email, $this->Usuario->nome);
        $this->from(env("MAIL_USERNAME"), env("APP_NAME"));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view(
            'Auth::mail.recovery-password', [
            'assunto' => $this->assunto,
            'usuario' => $this->Usuario,
            'token' => $this->Token
        ]);
    }
}
