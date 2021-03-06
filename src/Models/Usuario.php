<?php

namespace MOCSolutions\Auth\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;
use MOCSolutions\Core\Interfaces\Datatable;
use MOCSolutions\Core\Models\Documento;
use MOCSolutions\Core\Models\Telefone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Notifiable;


/**
 * Class Usuario
 * @package App\Http\Models\Auth
 * @property int id
 * @property string email
 * @property string nome
 * @property string cpf
 * @property string nascimento
 * @property string token
 * @property string senha
 * @property string dt_criacao
 */
class Usuario extends User implements Datatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = "auth_usuarios";

    public function can($abilities, $arguments = [])
    {
        return hasPermission($abilities);
    }

    /**
     * The perfil that belong to the user.
     */
    public function Perfis()
    {
        return $this->belongsToMany(
            Perfil::class,
            'auth_perfil_usuario',
            'id_usuario',
            'id_perfil');
    }

    public function Telefones()
    {
        return $this->belongsToMany(
            Telefone::class,
            'ncl_usuario_telefone',
            'id_usuario',
            'id_telefone');
    }

    public function Documentos()
    {
        return $this->hasMany(
            Documento::class,
            'id_usuario',
            'id');
    }

    /**
     * @param $email
     * @return bool|Usuario
     */
    public function checkUserEmail($email)
    {
        $result = $this->where("email", $email)->get();

        return $result->count() ? $result->first() : false;
    }

    public function getByEmail($email)
    {
        $result = $this->where("email", $email)->get();

        return $result->count() ? $result->first() : false;
    }

    /**
     * @param $search
     * @param $filtro
     * @return Model
     */
    public function getQuantidade($search, $filtro = false): int
    {
        $objetos = $this->refined($this, $search);
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
        $objetos = $this->refined($this, $search);
        $objetos = $this->filtrosForm($objetos, $filtro);

        return $objetos->count();
    }

    /**
     * @param $search
     * @param $start
     * @param $length
     * @param $filtro
     * @return Model|Collection
     */
    public function getResultadoBuscaPaginado($search, $start, $length, $filtro = false): Collection
    {
        $objetos = $this->select('id', 'nome', 'email', 'deleted_at');

        $objetos = $this->refined($objetos, $search);
        $objetos = $this->filtrosForm($objetos, $filtro);

        $objetos = $objetos
            ->orderByDesc('id')
            ->orderBy('nome')
            ->skip($start)
            ->take($length)
            ->get();

        return $objetos;
    }

    private function refined($objects, $search)
    {
        $objects = $objects->withTrashed();

        if ($search != null) {
            $objects = $objects->where(function ($q) use ($search) {
                $q->orWhere('nome', 'like', '%' . $search . '%');
                $q->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        return $objects;
    }

    private function filtrosForm($objetos, $filtros)
    {
        /*if ($filtros->servico != 0)
            $objetos = $objetos->where("servico_id", $filtros->servico);
        */
        return $objetos;
    }
}
