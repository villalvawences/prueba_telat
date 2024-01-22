<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableAddresses extends Migration
{
    public function up()
    {
        // $this->forge->addField([
        //     'id_direccion' => [
        //         'type' => 'INT',
        //         'constraint' => 5,
        //         'unsigned' => true,
        //         'auto_increment' => true,
        //     ],
        //     'cp' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 5,
        //     ],
        //     'colonia' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 100,
        //     ],
        //     'municipio' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 100,
        //     ],
        //     'estado' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 100,
        //     ],
        // ]);

        // $this->forge->addPrimaryKey('id_direccion');
        // $this->forge->createTable('direcciones');

        $this->db->query('CREATE TABLE direcciones (
            id_direccion INT(5) UNSIGNED AUTO_INCREMENT,
            cp VARCHAR(5),
            colonia VARCHAR(100),
            municipio VARCHAR(100),
            estado VARCHAR(100),
            PRIMARY KEY (id_direccion)
        ) ENGINE=InnoDB;
        ');
    }

    public function down()
    {
        $this->forge->dropTable('direcciones');
    }
}
