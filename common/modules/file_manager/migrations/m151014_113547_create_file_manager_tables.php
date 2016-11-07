<?php

use yii\db\Migration;
use \yii\db\mssql\Schema;

class m151014_113547_create_file_manager_tables extends Migration
{
    public $filesTableName = '{{%files}}';
    public $filesListsTableName = '{{%files_lists}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable($this->filesTableName, [
            'id' => 'BINARY(16) NOT NULL',
            'name' => Schema::TYPE_STRING . '(255) NOT NULL',
            'origin_name' => Schema::TYPE_STRING . '(255) NOT NULL',
            'mime' => Schema::TYPE_STRING . '(16) NOT NULL',
            'ext' => Schema::TYPE_STRING . '(8) NOT NULL',
            'alt' => Schema::TYPE_STRING . '(255)',
            'size' => Schema::TYPE_INTEGER . '(11)',
            'created_at' => Schema::TYPE_DATETIME,
            'updated_at' => Schema::TYPE_DATETIME,
            'files_list_id' => 'BINARY(16) DEFAULT NULL',
            'user_id' => Schema::TYPE_INTEGER . '(11) DEFAULT NULL',
            'PRIMARY KEY (id)'
        ], $tableOptions);

        $this->createIndex('FK_files_filesList_id', $this->filesTableName, 'files_list_id');

        $this->createTable($this->filesListsTableName, [
            'id' => 'BINARY(16) NOT NULL',
            'PRIMARY KEY (id)'
        ], $tableOptions);

        $this->addForeignKey(
            'FK_files_filesList_id', $this->filesTableName, 'files_list_id', $this->filesListsTableName, 'id', 'CASCADE', 'NO ACTION'
        );
    }

    public function down()
    {
        if($this->dropTable($this->filesTableName) AND $this->dropTable($this->filesListsTableName))
            return true;
        else
            return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
