<?php

use yii\db\Migration;

class m161107_072829_CREATE_TABLE_files_upload extends Migration
{
    public function up()
    {
        try {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
            }

            $this->createTable('files_upload', [
                'id' => $this->primaryKey(),
                'id_file' => 'INTEGER(11) NOT NULL',
            ], $tableOptions);
            $this->createIndex('CI_files_upload_files', 'files_upload', 'id_file');

            return true;

        } catch (Exception $e) {
            echo 'Exception: ', $e->getMessage(), "\n";
            $this->down();
            return false;
        }
    }

    public function down()
    {
        try {
            $table_to_check = Yii::$app->db->schema->getTableSchema('files_upload');
            if (is_object($table_to_check)) {
                $this->dropTable('files_upload');
            }
            return true;
        } catch (Exception $e) {
            echo 'Exception while down ' , $e->getMessage(), "\n";

            return false;
        }
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
