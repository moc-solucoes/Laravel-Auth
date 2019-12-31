<?php
/**
 * Created by PhpStorm.
 * User: maike.carvalho
 * Date: 01/08/2018
 * Time: 14:36
 */

namespace MOCSolutions\Auth\Models;

use Illuminate\Database\Eloquent\Model;

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
    public $timestamps = false;

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
}
