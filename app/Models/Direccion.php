<?php

namespace App\Models;

use CodeIgniter\Model;

class Direccion extends Model
{
    protected $table = 'direcciones';
    protected $primaryKey = 'id_direccion';

    protected $useAutoIncrement = true;

    protected $returnType = 'object'; //array
    protected $useSoftDeletes = false;

    protected $allowedFields = ['cp', 'colonia', 'municipio', 'estado'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
}
