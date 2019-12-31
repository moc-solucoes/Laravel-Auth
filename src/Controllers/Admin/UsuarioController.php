<?php

namespace MOCSolutions\Auth\Controllers\Admin;

use App\Http\Controllers\Controller;
use MOCSolutions\Auth\Models\Usuario;
use App\Http\Service\AdminService;
use MOCUtils\Helpers\Email;
use MOCUtils\Helpers\Password;

/**
 * Class UsuarioController
 * @package MOCSolutions\Auth\Controllers\Admin
 */
class UsuarioController extends Controller
{
    /**
     * @Permission[administrar.usuarios]
     */
    public function lista()
    {
        $usuarios = Usuario::all();

        foreach ($usuarios as $usuario) {
            $usuario->dt_criacao = convertToDateBr($usuario->dt_criacao);
            $usuario->cor = $usuario->ativo ? 'success' : 'danger';
        }

        return view('Auth::admin.usuario.lista', ['usuarios' => $usuarios]);
    }

    /**
     * @Permission[administrar.usuarios]
     */
    public function cadastrar()
    {
        return view('Auth::admin.usuario.cadastrar');
    }

    /**
     * @Permission[administrar.usuarios]
     */
    public function salvar()
    {
        request()->validate([
            'nome' => 'required',
            'email' => 'required|unique:' . (new Usuario)->getTable(),
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'email.unique' => 'Este e-mail já está cadastrado.'
        ]);

        $erros = [];

        $nome = request()->input('nome');
        $emailFrm = request()->input('email');

        $usuario = new Usuario();
        $usuario->nome = $nome;
        $usuario->email = $emailFrm;
        $usuario->senha = Password::generatePlain(10);

        $email = (new Email('novo_usuario', 'shared'))->setModel($usuario);
        $email->replaceAll();

        try {
            $email->send($emailFrm, $nome);
        } catch (\Exception $e) {
            $erros[] = "Seu e-mail não pode ser enviado contate um administrador.";
        }

        $pass = password(md5($usuario->senha));
        $usuario->senha = $pass['password'];
        $usuario->token = $pass['salt'];
        $usuario->save();

        return count($erros) ?
            view('Auth::admin.usuario.cadastrar', ['mensagem' => 'Usuário cadastrado com sucesso.'])->withErrors($erros) :
            view('Auth::admin.usuario.cadastrar', ['mensagem' => 'Usuário cadastrado com sucesso.']);
    }

    /**
     * @Permission[administrar.usuarios]
     */
    public function detalhes()
    {
        request()->validate([
            'usuario' => 'required',
        ], [
                'usuario.required' => "Parâmetro necessário não enviado.",
            ]
        );

        $service = (new AdminService())->getAllUser();

        if (count($service['error'])) return view("admin.usuario.detalhes", $service)->withErrors($service['error']);

        return view("Auth::admin.usuario.detalhes", $service);
    }
}
