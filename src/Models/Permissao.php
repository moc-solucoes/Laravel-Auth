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
use Illuminate\Support\Facades\DB;

/**
 * Class Permissao
 * @package App\Http\Models\Auth
 * @property integer id
 * @property string nome
 * @property string descricao
 * @property string tipo
 * @property string grupo
 * @property datetime dt_criacao
 */
class Permissao extends Model
{
    protected $table = 'auth_permissoes';
    public $timestamps = false;

    /**
     * The perfil that belong to the user.
     */
    public function Permissoes()
    {
        return $this->belongsToMany(
            Perfil::class,
            'auth_perfil_permissao',
            'id_permissao',
            'id_perfil');
    }

    /**
     * @param $idUsuario
     * @return array
     */
    public static function getByUsuario($idUsuario)
    {
        $query = "SELECT nome
                    FROM auth_permissoes
                    WHERE id IN (SELECT id_permissao
                        FROM auth_perfil_permissao
                        WHERE id_perfil IN (SELECT id
                             FROM auth_perfis
                             WHERE id IN
                                (SELECT id_perfil FROM auth_perfil_usuario WHERE id_usuario = :id_usuario)))
                                GROUP BY nome;";

        return DB::select($query, [':id_usuario' => $idUsuario]);
    }

    /**
     * @param $idUsuario
     * @return Permissao[]
     */
    public function getByUser($idUsuario)
    {
        $permissoes = $this->selectRaw('nome')->whereIn('id', function ($perfilPermissoes) use ($idUsuario) {
            $perfilPermissoes->selectRaw('id_permissao')->from('auth_perfil_permissao')
                ->whereIn('id_perfil', function ($perfil) use ($idUsuario) {
                    $perfil->selectRaw('id')->from((new Perfil())->getTable())
                        ->whereIn('id', function ($perfilUsuario) use ($idUsuario) {
                            $perfilUsuario->selectRaw('id_perfil')->from('auth_perfil_usuario')
                                ->where('id_usuario', $idUsuario);
                        });
                });
        })->groupby('nome')->get();

        return $permissoes;
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
                $q->where('descricao', 'like', '%' . $search . '%');
                $q->where('tipo', 'like', '%' . $search . '%');
                $q->where('grupo', 'like', '%' . $search . '%');
            });

        $objetos = $this->filtrosForm($objetos, $filtro);

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
                $q->where('descricao', 'like', '%' . $search . '%');
                $q->where('tipo', 'like', '%' . $search . '%');
                $q->where('grupo', 'like', '%' . $search . '%');
            });
        }

        $objetos = $this->filtrosForm($objetos, $filtro);

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
        $objetos = $this->select('id', 'nome', 'descricao', 'tipo', 'grupo', 'created_at', 'updated_at', 'deleted_at');

        if ($search != null) {
            $objetos = $objetos->where(function ($q) use ($search) {
                $q->where('nome', 'like', '%' . $search . '%')
                    ->orWhere('descricao', 'like', '%' . $search . '%')
                    ->orWhere('tipo', 'like', '%' . $search . '%')
                    ->orWhere('grupo', 'like', '%' . $search . '%');
            });
        }

        $objetos = $this->filtrosForm($objetos, $filtro);

        $objetos = $objetos
            ->orderBy('nome')
            ->orderByDesc('id')
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
