<?php

namespace MOCSolutions\Auth\Models;

use MocOrm\Support\Model;

/**
 * Class Empresa
 * @package App\Http\Models\Auth
 * @property integer id
 * @property integer id_imagem
 * @property string razao_social
 * @property string nome_fantasia
 * @property string email
 * @property string cnpj
 * @property boolean system
 * @property datetime dt_criacao
 */
class Empresa extends Model
{
    protected $table = 'auth_empresas';
    public $timestamps = false;

    public function checkEmpresaByCnpj($email)
    {
        $result = $this->where("cnpj", $email)->get();

        return count($result) ? $result[0] : false;
    }
}
