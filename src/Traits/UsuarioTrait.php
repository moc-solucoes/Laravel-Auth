<?php

namespace MOCSolutions\Auth\Traits;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use MOCSolutions\Auth\Models\Permissao;
use MOCSolutions\Auth\Models\Token;
use MOCSolutions\Auth\Models\Usuario;

trait UsuarioTrait
{
    /**
     * @param bool $md5
     * @return array
     * @throws \Exception
     */
    protected function _authenticate($md5 = false, $api = false)
    {
        if (request()->has('email') and request()->has('senha')) {
            if (!$api && request()->session()->get("usuario")) {
                throw new \Exception('Sessão já aberta para este dispositivo. ');
            }

            $email = request()->input('email');
            $senha = request()->input('senha');

            $senha = $md5 ? md5($senha) : $senha;

            $usuario = (new Usuario())->checkUserEmail($email);

            if ($usuario) {
                $encryptedPassword = password($senha, $usuario->token);

                if ($usuario->senha == $encryptedPassword['password']) {
                    Auth::login($usuario, true);

                    $usuario->Permissoes = (new Permissao())->getByUser($usuario->id) ?: [];

                    $usuario = $api ? $this->formatToApi($usuario) : $usuario;

                    if (!$api) {
                        request()->session()->put('usuario', (object)$usuario->toArray());
                    }

                    return ['mensagem' => "Usuário autenticado com sucesso.", "usuario" => $usuario];
                } else {
                    throw new \Exception('Senha inválida.');
                }
            } else {
                throw new \Exception('E-mail não cadastrado.');
            }
        }
    }

    private function formatToApi(Usuario $usuario)
    {
        $usuario->Permissoes = $usuario->Permissoes->mode('nome');

        $token = new Token();
        $token->token = md5($usuario->id . time());
        $token->id_usuario = $usuario->id;
        $token->expiracao = Carbon::now()->addHour(3)->toDateTimeString();
        $token->server_info = collect($_SERVER)->toJson();
        $token->save();

        $usuario->token = $token->token;

        return $usuario->only('id', 'nome', 'email', 'token', 'Permissoes');
    }
}
