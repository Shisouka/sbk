<?php

use yii\db\Migration;

class m160616_093507_CREATE_TABLE_files extends Migration
{
    public $tableName = '{{%files}}';

    public function safeUp() {

        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            $this->tableName, [
            'id' => $this->primaryKey(),
            'name' => 'VARCHAR(255) NOT NULL',
            'origin_name' => 'VARCHAR(255) NOT NULL',
            'mime' => 'VARCHAR(16) NOT NULL',
            'ext' => 'VARCHAR(8) NOT NULL',
            'alt' => 'VARCHAR(255) NULL',
            'size' => 'INT NULL',
            'created_at' => 'DATETIME NULL',
            'updated_at' => 'DATETIME NULL',
            'files_list_id' => 'INT(11) NULL',
            'user_id' => 'INT(11) NULL',
            'sort' => 'INT NOT NULL DEFAULT "1"',
        ], $tableOptions
        );

        $this->createIndex('CI_files_list_id', $this->tableName, 'files_list_id');

    }

    public function safeDown() {
        $this->dropTable($this->tableName);
    }
}
