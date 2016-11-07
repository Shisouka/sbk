<?php

use yii\db\Migration;

class m160427_101423_TABLE__files_ADD_COLUMN_sort extends Migration
{
    public $tableName = 'files';

    public function up() {

        try {
            $this->addColumn($this->tableName, 'sort', \yii\db\mysql\Schema::TYPE_INTEGER.' NOT NULL DEFAULT 1');
        } catch (Exception $e) {
            echo 'Exception: ',  $e->getMessage(), "\n";
            $this->down();
            return false;
        }

    }

    public function down()
    {
        try {
            $table = \Yii::$app->db->schema->getTableSchema($this->tableName);
            if($table->getColumn('sort'))
                $this->dropColumn($this->tableName,'sort');
            return true;
        } catch (Exception $e) {
            echo 'Exception: ',  $e->getMessage(), "\n";
            return false;
        }
    }
}
