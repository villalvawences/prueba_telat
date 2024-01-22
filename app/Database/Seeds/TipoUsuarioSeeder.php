<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TipoUsuarioSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'tipo_usuario' => 'Administrativos',
        ];

        $this->db->table('tipos_usuarios')->insert($data);

        $data2 = [
            'tipo_usuario' => 'Administrativos-Operativos',
        ];

        $this->db->table('tipos_usuarios')->insert($data2);

        $data3 = [
            'tipo_usuario' => 'Operativos',
        ];

        $this->db->table('tipos_usuarios')->insert($data3);
    }
}
