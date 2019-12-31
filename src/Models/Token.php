<?php
/**
 * Created by PhpStorm.
 * User: maike.carvalho
 * Date: 01/08/2018
 * Time: 14:36
 */

namespace MOCSolutions\Auth\Models;

use MocOrm\Support\Model;

class Token extends Model
{
    static $table_name = 'auth_tokens';
    static $primary_key = 'id';
}
