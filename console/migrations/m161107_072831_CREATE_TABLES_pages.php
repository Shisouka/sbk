<?php

use yii\db\Migration;

class m161107_072831_CREATE_TABLES_pages extends Migration
{
    public function up()
    {
        try {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
            }

            $this->createTable('pages', [
                'id' => $this->primaryKey(),
                'slug' => 'VARCHAR(255) NOT NULL UNIQUE',
                'meta_title' => 'VARCHAR(255) NOT NULL',
                'text' => 'TEXT NOT NULL',
            ], $tableOptions);


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
            $table_to_check = Yii::$app->db->schema->getTableSchema('pages');
            if (is_object($table_to_check)) {
                $this->dropTable('pages');
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
