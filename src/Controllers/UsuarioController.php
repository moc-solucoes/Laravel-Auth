<?php

namespace MOCSolutions\Auth\Controllers;

use App\Http\Controllers\Controller;
use MOCSolutions\Auth\Models\Permissao;
use MOCSolutions\Auth\Models\TokenSenha;
use MOCSolutions\Auth\Models\Usuario;
use MOCSolutions\Auth\Traits\UsuarioTrait;
use MOCSolutions\Core\Models\Documento;
use MOCSolutions\Core\Models\Telefone;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use MOCUtils\Helpers\Email;
use MOCUtils\Helpers\Password;
use MOCUtils\Helpers\SlackException;
use MOCUtils\Helpers\Transaction;

/**
 * Class UsuarioController
 * @package App\Http\Controllers\Auth
 */
class UsuarioController extends Controller
{
    use UsuarioTrait;

    /**
     * @NotClinica
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        request()->session()->flush();
        auth()->logout();
        return redirect()->route('usuario.logar');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function meusDados()
    {
        $usuario = user();

        return view('Auth::usuario.index', ['usuario' => $usuario]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function alterarSenha()
    {
        $request = request();

        $request->validate([
            'old' => 'required',
            'new' => 'required',
            're-new' => 'required',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
        ]);

        $erros = [];
        $id = user()->id;

        $usuario = Usuario::find($id);

        $pass = password(md5($request->input('old')), $usuario->token);
        $new = md5($request->input('new'));
        $renew = md5($request->input('re-new'));

        try {
            if ($pass['password'] != $usuario->senha) {
                throw new \Exception('Senha atual inválida.');
            }

            if ($new != $renew) {
                throw new \Exception('Os campos Nova Senha e "Repetição de Senha" tem que ser iguais.');
            }

            $trasaction = new Transaction(function () use ($request, $usuario, $new) {
                $pass = password($new);
                $usuario->senha = $pass['password'];
                $usuario->token = $pass['salt'];
                $usuario->save();

                return $usuario;
            });

        } catch (\Exception $e) {
            $erros[] = $e->getMessage();

            $trasaction = new Transaction(function () use ($usuario) {
                return $usuario;
            });
        }

        if ($trasaction->hasError()) {
            $erros[] = $message = $trasaction->getError()->getMessage();

            new SlackException($message);
        }

        $usuario = $trasaction->getResults();

        if (count($erros)) {
            return redirect()->back()->withErrors($erros);
        }

        return redirect()->back()->with('mensagem', "Senha do usuário <code>" . $usuario->nome . "</code> alterada com sucesso. ");
    }

    /**
     * All Open pages are in down
     */

    /**
     * @OpenPage
     */
    public function recuperarSenha()
    {
        return view('Auth::usuario.recuperar');
    }

    /**
     * @OpenPage
     */
    public function recuperarSenhaSalvar()
    {
        request()->validate([
            'email' => 'required'
        ]);

        $email = request()->input('email');
        $usuario = (new Usuario())->getByEmail($email);

        if (!$usuario)
            return redirect()->route('usuario.logar')->withErrors("E-mail não existente em nossa base de dados.");

        $token = new TokenSenha();
        $token->token = md5(time());
        $token->server_info = json_encode($_SERVER);
        $token->expiracao = Carbon::now()->addDay()->toDateTimeString();
        $token->id_usuario = $usuario->id;
        $token->save();

        $token->expiracao = (new Carbon($token->expiracao))->format('d/m/Y H:m:i');

        //ToDo Implmentar o envio do e-mail.
        $email = (new Email('recuperar_senha', 'shared'))->setModel($usuario)->setModel($token);
        $email->replaceAll();

        try {
            $email->send($usuario->email, $usuario->nome);
        } catch (\Exception $e) {
            return redirect()->route('usuario.logar')->withErrors("Seu e-mail não pode ser enviado contate um administrador.");
        }

        return redirect()->route('usuario.logar')->with('message', 'Foi enviado um e-mail com instrução para concluir sua recuperação da senha.');
    }

    /**
     * OpenPage
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loginView()
    {
        return view("Auth::usuario.login");
    }

    /**
     * @OpenPage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login()
    {
        request()->validate([
            'email' => 'required',
            'senha' => 'required',
        ]);

        try {
            $result = $this->_authenticate(true);

            return redirect()->route('inicio');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * @OpenPage
     */
    public function cadastrar()
    {
        return view('Auth::usuario.cadastrar');
    }

    /**
     * @OpenPage
     */
    public function salvar()
    {
        request()->validate([
            'nome' => 'required',
            'email' => 'required|unique:' . (new Usuario)->getTable(),
            'celular' => 'required',
            'cpf' => 'required',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'email.unique' => 'Este e-mail já está cadastrado.'
        ]);

        $erros = [];

        $nome = request()->input('nome');
        $emailFrm = request()->input('email');
        $tel = request()->input('telefone');
        $cel = request()->input('celular');
        $cpf = request()->input('cpf');

        $usuario = new Usuario();
        $usuario->nome = $nome;
        $usuario->email = $emailFrm;
//        $usuario->senha = Password::generatePlain(10);
        $usuario->senha = request()->input('senha');

        try {
            $email = (new Email('novo_usuario', 'shared'))->setModel($usuario);
            $email->replaceAll();

            $email->send($emailFrm, $nome);
        } catch (\Exception $e) {
            $erros[] = "Seu e-mail não pode ser enviado contate um administrador.";
        }

        $pass = password(md5($usuario->senha));
        $usuario->senha = $pass['password'];
        $usuario->token = $pass['salt'];

        $transaction = new Transaction(function () use ($usuario, $cel, $tel, $cpf) {
            $usuario->save();

            $telefone = new Telefone();
            $telefone->setTelefone($tel);
            $telefone->tipo = 'Residêncial';
            $telefone->save();

            $usuario->Telefones()->save($telefone);

            if (!empty($tel)) {
                $telefone = new Telefone();
                $telefone->setTelefone($cel);
                $telefone->tipo = 'Celular';
                $telefone->save();

                $usuario->Telefones()->save($telefone);
            }

            $documento = new Documento();
            $documento->setCpf($cpf);
            $documento->setDocumentoCompleto($documento);
            $documento->save();

            $usuario->Documentos()->save($documento);

            return $usuario;
        });

        if ($transaction->hasError()) {
            $erros[] = $message = $transaction->getError()->getMessage();

            new SlackException($message);
        }

        if (count($erros)) {
            return redirect()->back()->withErrors($erros);
        }

        return $this->login();
    }

    /**
     * @OpenPage
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function recuperarSenhaToken($token)
    {
        $token = (new TokenSenha())->getByToken($token);

        if ($token->count() < 1)
            return redirect()->route('usuario.logar')->withErrors("Token não existente em nossa base de dados.");

        $token = $token->first();

        if ($token->expiracao < Carbon::now()->toDateTimeString())
            return redirect()->route('usuario.logar')->withErrors("Este token está expirado.");

        return view('Auth::usuario.nova_senha', ['token' => $token]);
    }

    /**
     * @OpenPage
     */
    public function recuperarSenhaTokenSalvar($token)
    {
        $token = (new TokenSenha())->getByToken($token);

        if ($token->count() < 1)
            return redirect()->route('usuario.logar')->withErrors("Token não existente em nossa base de dados.");

        $token = $token->first();

        if ($token->expiracao < Carbon::now()->toDateTimeString())
            return redirect()->route('usuario.logar')->withErrors("Este token está expirado.");

        request()->validate([
            'new' => 'required',
            're-new' => 'required',
        ]);

        $new = request()->input('new');
        $reNew = request()->input('re-new');

        if ($new != $reNew)
            redirect()->back()->withErrors('As senhas devem ser iguais.');

        $pass = password(md5($new));
        $token->Usuario->senha = $pass['password'];
        $token->Usuario->token = $pass['salt'];
        $token->Usuario->save();

        $token->ativo = false;
        $token->save();

        $token->Usuario->Permissoes = (new Permissao())->getByUser($token->Usuario->id) ?: [];
        Session::put('usuario', (object)$token->Usuario->toArray());

        return redirect()->route('inicio');
    }
}
