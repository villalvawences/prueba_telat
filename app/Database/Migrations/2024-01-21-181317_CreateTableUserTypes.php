<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableUserTypes extends Migration
{
    public function up()
    {
        // $this->forge->addField([
        //     'id_tipo_usuario' => [
        //         'type' => 'INT',
        //         'constraint' => 5,
        //         'unsigned' => true,
        //         'auto_increment' => true,
        //     ],
        //     'tipo_usuario' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 50,
        //     ]
        // ]);

        // $this->forge->addPrimaryKey('id_tipo_usuario');
        // $this->forge->createTable('tipos_usuarios');

        $this->db->query('CREATE TABLE tipos_usuarios (
            id_tipo_usuario INT(5) UNSIGNED AUTO_INCREMENT,
            tipo_usuario VARCHAR(50),
            PRIMARY KEY (id_tipo_usuario)
        ) ENGINE=InnoDB;
        ');
    }

    public function down()
    {
        $this->forge->dropTable('tipos_usuarios');
    }
}
