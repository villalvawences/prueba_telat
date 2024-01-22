<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableUsers extends Migration
{
    public function up()
    {
        //     $this->forge->addField([
        //         'id_usuario' => [
        //             'type' => 'INT',
        //             'constraint' => 5,
        //             'unsigned' => true,
        //             'auto_increment' => true,
        //         ],
        //         'nombre' => [
        //             'type' => 'VARCHAR',
        //             'constraint' => 50,
        //         ],
        //         'apellidos' => [
        //             'type' => 'VARCHAR',
        //             'constraint' => 120,
        //         ],
        //         'sexo' => [
        //             'type'       => 'ENUM',
        //             'constraint' => ['M', 'F'],
        //         ],
        //         'correo_electronico' => [
        //             'type' => 'VARCHAR',
        //             'constraint' => 50,
        //             'unique'     => true,
        //         ],
        //         'password' => [
        //             'type' => 'VARCHAR',
        //             'constraint' => 8,
        //         ],
        //         'telefono' => [
        //             'type' => 'VARCHAR',
        //             'constraint' => 10,
        //         ],
        //         'status' => [
        //             'type'       => 'ENUM',
        //             'constraint' => ['0', '1'],
        //             'default'    => '1',
        //         ],
        //         'id_direccion' => [
        //             'type' => 'INT',
        //             'constraint' => 5,

        //         ],
        //         'id_tipo_usuario' => [
        //             'type' => 'INT',
        //             'constraint' => 5,

        //         ],
        //         'fecha_registro' => [
        //             'type' => 'DATETIME',
        //         ],

        //     ]);

        //     $this->forge->addPrimaryKey('id_usuario');
        //     $this->forge->addForeignKey('id_direccion', 'direcciones', 'id_direccion', 'CASCADE', 'CASCADE');
        //     $this->forge->addForeignKey('id_tipo_usuario', 'tipos_usuarios', 'id_tipo_usuario', 'CASCADE', 'CASCADE');

        //     $this->forge->createTable('usuarios');
        $this->db->query('
            CREATE TABLE usuarios (
                id_usuario INT(5) UNSIGNED AUTO_INCREMENT,
                nombre VARCHAR(50),
                apellidos VARCHAR(120),
                sexo ENUM("M", "F"),
                correo_electronico VARCHAR(50) UNIQUE,
                password VARCHAR(8),
                telefono VARCHAR(10),
                status ENUM("0", "1") DEFAULT "1",
                id_direccion INT(5) UNSIGNED,
                id_tipo_usuario INT(5) UNSIGNED,
                fecha_registro DATETIME,
                PRIMARY KEY (id_usuario),
                CONSTRAINT fk_usuarios_direcciones FOREIGN KEY (id_direccion) REFERENCES direcciones (id_direccion) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT fk_usuarios_tipos_usuario FOREIGN KEY (id_tipo_usuario) REFERENCES tipos_usuarios (id_tipo_usuario) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB
        ');
    }

    public function down()
    {
        $this->forge->dropTable('usuarios');
    }
}
