<?php

namespace MOCSolutions\Auth\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Token
 * @package App\Http\Models\Auth
 * @property int id
 * @property int id_usuario
 * @property string token
 * @property string server_info
 * @property datetime expiracao
 * @property datetime dt_criacao
 */
class Token extends Model
{
    protected $table = "auth_tokens";

    public function Usuario()
    {
        return $this->hasOne(Usuario::class, 'id', 'id_usuario');
    }
}
