<?php

namespace MOCSolutions\Auth\Controllers\Api;

use App\Http\Controllers\Controller;
use MOCSolutions\Auth\Models\Perfil;
use MOCSolutions\Auth\Models\Permissao;
use MOCSolutions\Auth\Models\Usuario;

/**
 * Class AgendamentoController
 * @package App\Http\Controllers
 */
class UsuarioController extends Controller
{
    public function listarUsuario()
    {
        $start = request()->input('start');
        $length = request()->input('length');
        $draw = request()->input('draw');
        $search = request()->input('search')['value'];

        $filtro = (object)request()->input('filtro');

        $usuarios = (new Usuario)->getResultadoBuscaPaginado($search, $start, $length, $filtro);

        foreach ($usuarios as $usuario) {
            $usuario->secretariaImplode = $usuario->Secretarias->implode('descricaoSimplificada', ', ');
        }

        $result = [];
        $result['draw'] = $draw++;
        $result['data'] = $usuarios;
        $result['recordsTotal'] = (new Usuario)->getQuantidade($search, $filtro);
        $result['recordsFiltered'] = (new Usuario)->getTotalFiltrado($search, $filtro);

        return response()->json($result);
    }

    public function index()
    {
        $start = request()->input('start');
        $length = request()->input('length');
        $draw = request()->input('draw');
        $search = request()->input('search')['value'];

        $filtro = (object)request()->input('filtro');

        $usuarios = (new Usuario)->getResultadoBuscaPaginado($search, $start, $length, $filtro);

        foreach ($usuarios as $usuario) {
            $usuario->perfilImplode = $usuario->Perfis->implode('nome', ', ');
            $usuario->botoes = view("Auth::admin.permissao._botoes", ['usuario' => $usuario]);
        }

        $result = [];
        $result['draw'] = $draw++;
        $result['data'] = $usuarios;
        $result['recordsTotal'] = (new Usuario)->getQuantidade($search, $filtro);
        $result['recordsFiltered'] = (new Usuario)->getTotalFiltrado($search, $filtro);

        return response()->json($result);
    }

    public function perfis()
    {
        $start = request()->input('start');
        $length = request()->input('length');
        $draw = request()->input('draw');
        $search = request()->input('search')['value'];

        $perfis = (new Perfil())->getResultadoBuscaPaginado($search, $start, $length);

        foreach ($perfis as &$perfil) {
            $perfil->criado = convertToDateBr($perfil->created_at);
            $perfil->atualizado = convertToDateBr($perfil->updated_at);
        }

        $result = [];
        $result['draw'] = $draw++;
        $result['data'] = $perfis;
        $result['recordsTotal'] = (new Perfil)->getQuantidade($search);
        $result['recordsFiltered'] = (new Perfil)->getTotalFiltrado($search);

        return response()->json($result);
    }

    public function permissoes()
    {
        $start = request()->input('start');
        $length = request()->input('length');
        $draw = request()->input('draw');
        $search = request()->input('search')['value'];

        $permissoes = (new Permissao())->getResultadoBuscaPaginado($search, $start, $length);

        foreach ($permissoes as &$permissao) {
            $permissao->criado = convertToDateBr($permissao->created_at);
            $permissao->atualizado = convertToDateBr($permissao->updated_at);
            $permissao->botoes = view('Auth::admin.permissao._botoes', ['permissao' => $permissao])->render();
        }

        $result = [];
        $result['draw'] = $draw++;
        $result['data'] = $permissoes;
        $result['recordsTotal'] = (new Permissao)->getQuantidade($search);
        $result['recordsFiltered'] = (new Permissao)->getTotalFiltrado($search);

        return response()->json($result);
    }
}
