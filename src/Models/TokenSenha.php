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
 * Class TokenSenha
 * @package App\Http\Models\Auth
 * @property int id
 * @property int id_usuario
 * @property string token
 * @property string server_info
 * @property datetime expiracao
 * @property boolean ativo
 * @property datetime dt_criacao
 */
class TokenSenha extends Model
{
    protected $table = "auth_tokens_senha";
    public $timestamps = false;

    public function Usuario()
    {
        return $this->hasOne(
            Usuario::class,
            'id',
            'id_usuario');
    }

    public function getByToken($token)
    {
        return $this->where('token', $token)->where('ativo', true)->get();
    }
}
