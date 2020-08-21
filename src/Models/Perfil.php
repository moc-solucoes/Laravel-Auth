<?php
/**
 * Created by PhpStorm.
 * User: maike.carvalho
 * Date: 01/08/2018
 * Time: 14:36
 */

namespace MOCSolutions\Auth\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Perfil
 * @package App\Http\Models\Auth
 * @property integer id
 * @property string nome
 * @property boolean system
 * @property datetime dt_criacao
 */
class Perfil extends Model
{
    protected $table = 'auth_perfis';

    /**
     * The perfil that belong to the user.
     */
    public function Usuarios()
    {
        return $this->belongsToMany(
            Usuario::class,
            'auth_perfil_usuario',
            'id_perfil',
            'id_usuario');
    }

    /**
     * The permissões that belong to the user.
     */
    public function Permissoes()
    {
        return $this->belongsToMany(
            Permissao::class,
            'auth_perfil_permissao',
            'id_perfil',
            'id_permissao');
    }

    /**
     * @param $search
     * @param $filtro
     * @return Model
     */
    public function getQuantidade($search, $filtro = false): int
    {
        $objetos = $this
            ->where(function ($q) use ($search) {
                $q->where('nome', 'like', '%' . $search . '%');
            });

        $objetos = $this->filtrosForm($objetos, $filtro);
        $objetos = $objetos->where('system', false);

        $objetos = $objetos->count();

        return $objetos;
    }

    /**
     * @param $search
     * @param $filtro
     * @return Model
     */
    public function getTotalFiltrado($search, $filtro = false): int
    {
        $objetos = $this;

        if ($search != null) {
            $objetos = $objetos->where(function ($q) use ($search) {
                $q->where('nome', 'like', '%' . $search . '%');
            });
        }

        $objetos = $this->filtrosForm($objetos, $filtro);
        $objetos = $objetos->where('system', false);

        return $objetos->count();
    }

    /**
     * @param $search
     * @param $start
     * @param $length
     * @param $filtro
     * @return Model
     */
    public function getResultadoBuscaPaginado($search, $start, $length, $filtro = false): Collection
    {
        $objetos = $this->select('id', 'nome', 'created_at', 'updated_at', 'deleted_at');

        if ($search != null) {
            $objetos = $objetos->where(function ($q) use ($search) {
                $q->where('nome', 'like', '%' . $search . '%');
            });
        }

        $objetos = $this->filtrosForm($objetos, $filtro);

        $objetos = $objetos
            ->where('system', false)
            ->orderByDesc('id')
            ->orderBy('nome')
            ->skip($start)
            ->take($length)
            ->get();

        return $objetos;
    }

    private function filtrosForm($objetos, $filtros)
    {
        /*if ($filtros->servico != 0)
            $objetos = $objetos->where("servico_id", $filtros->servico);

        if (!is_null($filtros->data))
            $objetos = $objetos->where("data", $filtros->data);

        if ($filtros->horaInicio)
            $objetos = $objetos->where("hora_inicio", $filtros->horaInicio);

        if (!is_null($filtros->situacao))
            $objetos = $objetos->where("situacao", $filtros->situacao);*/

        return $objetos;
    }
}
