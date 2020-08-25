<?php

namespace MOCSolutions\Auth\Controllers\Admin;

use App\Http\Controllers\Controller;
use MOCSolutions\Auth\Models\Perfil;
use MOCSolutions\Auth\Models\Permissao;
use MOCSolutions\Auth\Models\Usuario;
use MOCUtils\Helpers\Email;
use MOCUtils\Helpers\Password;
use MOCUtils\Helpers\SlackException;
use MOCUtils\Helpers\Transaction;

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

        return view('Auth::admin.usuario.index', ['usuarios' => $usuarios]);
    }

    /**
     * @Permission[administrar.usuarios]
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cadastrar()
    {
        $perfis = Perfil::where('system', false)->get();

        return view('Auth::admin.usuario.cadastrar', ['perfis' => $perfis]);
    }

    /**
     * @Permission[administrar.usuarios]
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editar($id)
    {
        $usuario = Usuario::find($id);
        $perfis = Perfil::where('system', false)->get();

        foreach ($perfis as $perfil) {
            $perfil->checked = $usuario->Perfis->where('id', $perfil->id)->count();
        }

        return view('Auth::admin.usuario.editar', ['usuario' => $usuario, 'perfis' => $perfis]);
    }

    /**
     * @Permission[administrar.usuarios]
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvar()
    {
        request()->validate([
            'nome' => 'required',
            'senha' => 'required',
            'email' => 'required|unique:' . (new Usuario)->getTable(),
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'matricula.unique' => 'Esta matricula já está cadastrada.',
            'Auth::admin.usuario.unique' => 'Este usuário já está cadastrado.',
        ]);

        $erros = [];

        $transaction = new Transaction(function () {
            $nomeFrm = request()->input('nome');
            $emailFrm = request()->input('email');
            $senhaFrm = request()->input('senha');
            $pass = \password(md5($senhaFrm));

            $usuario = new Usuario();
            $usuario->nome = $nomeFrm;
            $usuario->email = $emailFrm;
            $usuario->nascimento = request()->input('nascimento');
            $usuario->cpf = request()->input('cpf');
            $usuario->senha = $pass['password'];
            $usuario->token = $pass['salt'];
            /*
                        $email = (new Email('novo_usuario', 'shared'))->setModel($usuario);
                        $email->replaceAll();

                        try {
                            $email->send($emailFrm, $nomeFrm);
                        } catch (\Exception $e) {
                            throw new SlackException("Seu e-mail não pode ser enviado contate um administrador.");
                        }
            */

            $usuario->save();
            $usuario->Perfis()->sync(request()->get('perfis'));

            return $usuario;
        });

        $retorno = $transaction->getResults();

        if ($transaction->hasError()) {
            $erros[] = $message = $transaction->getError()->getMessage();

            new SlackException($message);
        }

        if (count($erros)) {
            return redirect()->back()->withErrors($erros);
        }

        return redirect()->back()->with(['success' => "Usuário <code> $retorno->nome </code> salvo com sucesso."]);
    }

    /**
     * @Permission[administrar.usuarios]
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function salvarEditar($id)
    {

        request()->validate([
            'nome' => 'required',
            'email' => 'required|unique:' . (new Usuario)->getTable() . ',email,' . $id,
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'matricula.unique' => 'Esta matricula já está cadastrada.',
            'Auth::admin.usuario.unique' => 'Este usuário já está cadastrado.',
        ]);

        $erros = [];

        $transaction = new Transaction(function () use ($id) {
            $usuario = Usuario::find($id);
            $nomeFrm = request()->input('nome');
            $emailFrm = request()->input('email');

            $usuario->nome = $nomeFrm;
            $usuario->email = $emailFrm;
            $usuario->nascimento = request()->input('nascimento');
            $usuario->cpf = request()->input('cpf');
            $senhaFrm = request()->input('senha');

            if (!empty($senhaFrm)) {
                $pass = \password(md5($senhaFrm));
                $usuario->senha = $pass['password'];
                $usuario->token = $pass['salt'];
            }

            $usuario->save();
            $usuario->Perfis()->sync(request()->get('perfis'));

            return $usuario;
        });

        $retorno = $transaction->getResults();

        if ($transaction->hasError()) {
            $erros[] = $message = $transaction->getError()->getMessage();

            new SlackException($message);
        }

        if (count($erros)) {
            return redirect()->back()->withErrors($erros);
        }

        return redirect()->route('auth.admin.usuario')->with(['success' => "Usuário <code> $retorno->nome </code> editado com sucesso."]);
    }

    /**
     * @Permission[administrar.usuarios.perfis]
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function perfis()
    {
        return view('Auth::admin.perfil.index');
    }

    /**
     * @Permission[administrar.usuarios.perfis]
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cadastrarPerfil()
    {
        $permissoes = Permissao::all();
        $permissions = $permissoes->groupBy('tipo');
        return view('Auth::admin.perfil.cadastrar', ['permissoes' => $permissions]);
    }

    /**
     * @Permission[administrar.usuarios.perfis]
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editarPerfil($id)
    {
        $permissoes = Permissao::all();
        $perfil = Perfil::find($id);

        foreach ($permissoes as $permissao) {
            $permissao->checked = $perfil->Permissoes->where('id', $permissao->id)->count();
        }

        $permissions = $permissoes->groupBy('tipo');

        return view('Auth::admin.perfil.editar', ['perfil' => $perfil, 'permissoes' => $permissions]);
    }

    /**
     * @Permission[administrar.usuarios.perfis]
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvarEditarPerfil($id)
    {
        request()->validate([
            'nome' => 'required',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
        ]);

        $trasaction = new Transaction(function () use ($id) {
            $perfil = Perfil::find($id);
            $perfil->nome = request()->get('nome');
            $perfil->save();
            $perfil->Permissoes()->sync(request()->get('permissoes'));

            return $perfil;
        });

        $erros = collect();

        $retorno = $trasaction->getResults();

        if ($trasaction->hasError()) {
            $message = $trasaction->getError()->getMessage();
            $erros->push($message);
        }

        if (count($erros)) {
            return redirect()->back()->withErrors($erros);
        }

        return redirect()->route('auth.admin.usuario.perfil')->with(['success' => "Perfil <code> $retorno->nome </code> editado com sucesso."]);
    }

    /**
     * @Permission[administrar.usuarios.perfis]
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvarPerfil()
    {
        request()->validate([
            'nome' => 'required',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
        ]);

        $trasaction = new Transaction(function () {
            $perfil = new Perfil();
            $perfil->nome = request()->get('nome');
            $perfil->save();
            $perfil->Permissoes()->sync(request()->get('permissoes'));

            return $perfil;
        });

        $erros = collect();

        $retorno = $trasaction->getResults();

        if ($trasaction->hasError()) {
            $message = $trasaction->getError()->getMessage();
            $erros->push($message);
        }

        if (count($erros)) {
            return redirect()->back()->withErrors($erros);
        }

        return redirect()->route('auth.admin.usuario.perfil')->with(['success' => "Perfil <code> $retorno->nome </code> salvo com sucesso."]);
    }

    /**
     * @Permission[administrar.usuarios.permissoes]
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cadastrarPermissao()
    {
        return view('Auth::admin.permissao.cadastrar');
    }

    /**
     * @Permission[administrar.usuarios.permissoes]
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvarPermissao()
    {
        request()->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'tipo' => 'required',
            'grupo' => 'required',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
        ]);

        $trasaction = new Transaction(function () {
            $permissao = new Permissao();
            $permissao->nome = request()->get('nome');
            $permissao->descricao = request()->get('descricao');
            $permissao->tipo = request()->get('tipo');
            $permissao->grupo = request()->get('grupo');
            $permissao->save();

            return $permissao;
        });

        $erros = collect();

        $retorno = $trasaction->getResults();

        if ($trasaction->hasError()) {
            $message = $trasaction->getError()->getMessage();
            $erros->push($message);
        }

        if (count($erros)) {
            return redirect()->back()->withErrors($erros);
        }

        return redirect()->back()->with(['success' => "Permissão <code> $retorno->nome </code> salva com sucesso."]);
    }

    /**
     * @Permission[administrar.usuarios.permissoes]
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function permissoes()
    {
        return view('Auth::admin.permissao.index');
    }


    /**
     * @Permission[administrar.usuarios.permissoes]
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editarPermissao($id)
    {
        return view('Auth::admin.permissao.editar', [
            'permissao' => Permissao::find($id)
        ]);
    }

    /**
     * @Permission[administrar.usuarios.permissoes]
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvarEdicaoPermissao($id)
    {
        request()->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'tipo' => 'required',
            'grupo' => 'required',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
        ]);

        $trasaction = new Transaction(function () use ($id) {
            $permissao = Permissao::find($id);
            $permissao->nome = request()->get('nome');
            $permissao->descricao = request()->get('descricao');
            $permissao->tipo = request()->get('tipo');
            $permissao->grupo = request()->get('grupo');
            $permissao->save();

            return $permissao;
        });

        $erros = collect();

        $retorno = $trasaction->getResults();

        if ($trasaction->hasError()) {
            $message = $trasaction->getError()->getMessage();
            $erros->push($message);
        }

        if (count($erros)) {
            return redirect()->back()->withErrors($erros);
        }

        return redirect()->back()->with(['success' => "Permissão <code> $retorno->nome </code> editada com sucesso."]);
    }

}
