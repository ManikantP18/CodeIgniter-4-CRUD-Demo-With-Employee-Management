<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => TRUE,
                ],
                'first_name' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'default' => null
                ],
                'last_name' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'default' => null
                ],
                'email' => [
                    'type' => 'VARCHAR',
                    'constraint' => 350,
                    'default' => null
                ],
                'country_code' => [
                    'type' => 'INT',
                    'constraint' => 5,
                ],
                'mobile' => [
                    'type' => 'BIGINT',
                    'constraint' => 20,
                ],
                'address' => [
                    'type' => 'TEXT',
                    'constraint' => 4,
                ],
                'gender' => [
                    'type' => 'TINYINT',
                    'constraint' => 2,
                    'default' => '1',
                    'comment' => ' 1- Male, 2 - Female'
                ],
                'hobby' => [
                    'type' => 'VARCHAR',
                    'constraint' => 350,
                    'default' => null
                ],
                'image' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                ],
                'is_deleted' => [
                    'type' => 'TINYINT',
                    'constraint' => 2,
                    'default' => '1',
                    'comment' => '1 - active, 2 - deleted'
                ],
                'created_at datetime default current_timestamp',
            ]
        );
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('employees');
    }

    public function down()
    {
        $this->forge->dropTable('employees');
    }
}
