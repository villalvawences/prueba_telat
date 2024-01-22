<?php

namespace App\Models;

use CodeIgniter\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $useAutoIncrement = true;

    protected $returnType = 'object'; //array
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombre', 'apellidos', 'sexo', 'correo_electronico', 'password', 'telefono', 'status', 'id_direccion', 'id_tipo_usuario', 'fecha_registro'];

    public function direccion()
    {
        return $this->hasOne(Direccion::class, 'id_direccion', 'id_direccion');
    }

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
}
