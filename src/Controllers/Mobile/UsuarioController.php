<?php

namespace MOCSolutions\Auth\Controllers\Mobile;

use App\Http\Controllers\Controller;
use MOCSolutions\Auth\Models\Usuario;
use MOCSolutions\Auth\Traits\UsuarioTrait;

/**
 * Class UsuarioController
 * @package App\Http\Controllers
 */
class UsuarioController extends Controller
{
    use UsuarioTrait;

    /**
     * @OpenPage
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        try {
            $result = $this->_authenticate(true, true);

            return return_json($result['mensagem'], $result['usuario']);
        } catch (\Exception $e) {
            return return_json($e->getMessage(), null, true);
        }
    }

    /**
     * @Permission
     * @return \Illuminate\Http\JsonResponse
     */
    public function salvar()
    {
        try {
            if (
                request()->has("nome") &&
                request()->has("senha") &&
                request()->has("email")
            ) {
                $email = request()->input("email");

                $usuario = (new Usuario())->checkUserEmail($email);

                if (!$usuario) {
                    $pass = password(request()->input("senha"));

                    $transaction = new Transaction(function () use ($pass) {
                        $usuario = new Usuario();
                        $usuario->nome = trim(request()->input("nome"));

                        if (!strpos($usuario->nome, " ")) {
                            throw new \Exception("Nome completo incorreto.");
                        }

                        $usuario->email = request()->input("email");
                        $usuario->senha = $pass['password'];
                        $usuario->token = $pass['salt'];
                        $usuario->save();

                        $redmine = (new Redmine())->createUser($usuario);

                        $usuarioRedmine = new \App\Http\Models\Redmine\Usuario();
                        $usuarioRedmine->id_usuario = $usuario->id;
                        $usuarioRedmine->id_redmine = $redmine->id;
                        $usuarioRedmine->key = $redmine->api_key;
                        $usuarioRedmine->save();

                        return $usuario;
                    });

                    if ($transaction->hasError()) throw new \Exception($transaction->getError()->getMessage());

                    return response()->json(["error" => false, "message" => "Usuário salvo com sucesso."]);
                } else {
                    return response()->json(["error" => true, "message" => "E-mail já cadastrado."]);
                }
            } else {
                return response()->json(["error" => true, "message" => "Campos obrigatórios não preenchidos."]);
            }
        } catch (\Exception $e) {
            return response()->json(["error" => true, "message" => $e->getMessage()]);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            request()->session()->remove('usuario');

            return return_json('Usuário deslogado com sucesso.', null, false);
        } catch (\Exception $e) {
            return return_json($e->getMessage(), null, true);
        }
    }
}
