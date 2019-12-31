<?php

namespace MOCSolutions\Auth\Models;

use App\Http\Models\Fatura\Fatura;
use MOCSolutions\Core\Models\Documento;
use MOCSolutions\Core\Models\Projeto;
use MOCSolutions\Core\Models\Telefone;
use Illuminate\Database\Eloquent\Model;

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
class Usuario extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    protected $table = "auth_usuarios";
    public $timestamps = false;

    public function UsuarioRedmine()
    {
        return $this->hasOne(
            \App\Http\Models\Redmine\Usuario::class,
            'id_usuario',
            'id');
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

    public function Faturas()
    {
        return $this->belongsToMany(
            Fatura::class,
            'fatura_usuarios',
            'id_usuario',
            'id_fatura');
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

    public function checkUserEmail($email)
    {
        $result = $this->where("email", $email)->get();

        return count($result) ? $result[0] : false;
    }

    public function getByEmail($email)
    {
        $result = $this->where("email", $email)->get();

        return $result->count() ? $result->first() : false;
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return $this->nome;
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->senha;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        // TODO: Implement getRememberToken() method.
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     * @return void
     */
    public function setRememberToken($value)
    {
        // TODO: Implement setRememberToken() method.
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        // TODO: Implement getRememberTokenName() method.
    }
}
