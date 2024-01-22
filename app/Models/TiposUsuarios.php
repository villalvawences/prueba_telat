<?php

namespace App\Models;

use CodeIgniter\Model;

class TiposUsuarios extends Model
{
    protected $table = 'tipos_usuarios';
    protected $primaryKey = 'id_tipo_usuarios';

    protected $useAutoIncrement = true;

    protected $returnType = 'object'; //array
    protected $useSoftDeletes = false;

    protected $allowedFields = ['tipo_usuario'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
}
