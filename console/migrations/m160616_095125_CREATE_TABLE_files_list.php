<?php

use yii\db\Migration;

class m160616_095125_CREATE_TABLE_files_list extends Migration
{
    public $tableName = '{{%files_list}}';

    public function safeUp() {

        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            $this->tableName, [
            'id' => $this->primaryKey(),
        ], $tableOptions
        );

    }

    public function safeDown() {
        $this->dropTable($this->tableName);
    }
}
