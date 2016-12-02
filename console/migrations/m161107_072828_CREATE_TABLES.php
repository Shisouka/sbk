<?php

use yii\db\Migration;

class m161107_072828_CREATE_TABLES extends Migration
{
    public function up()
    {
        try {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
            }

            $this->createTable('catalog', [
                'id' => $this->primaryKey(),
                'name' => 'VARCHAR(255) NOT NULL',
                'title' => 'VARCHAR(255) NULL',
                'meta_title' => 'VARCHAR(255) NULL',
                'slug' => 'VARCHAR(255) NOT NULL UNIQUE',
                'sort' => 'INT(11) NOT NULL DEFAULT "1"',
            ], $tableOptions);
            $this->createIndex('CI_catalog_slug', 'catalog', 'slug');



            $this->createTable('subcatalog', [
                'id' => $this->primaryKey(),
                'id_catalog' => 'INT(11) NOT NULL',
                'title' => 'VARCHAR(255) NULL',
                'meta_title' => 'VARCHAR(255) NULL',
                'name' => 'VARCHAR(255) NOT NULL',
                'slug' => 'VARCHAR(255) NOT NULL UNIQUE',
                'sort' => 'INT(11) NOT NULL DEFAULT "1"',
            ], $tableOptions);
            $this->createIndex('CI_subcatalog_slug', 'subcatalog', 'slug');
            $this->createIndex('CI_subcatalog_2_catalog', 'subcatalog', 'id_catalog');



            $this->createTable('catalog_content', [
                'id' => $this->primaryKey(),
                'id_catalog' => 'INT(11) NOT NULL DEFAULT "0"',
                'id_subcatalog' => 'INT(11) NOT NULL DEFAULT "0"',
                'title' => 'VARCHAR(255) NOT NULL',
                'content' => 'MEDIUMTEXT NOT NULL',
                'sort' => 'INT(11) NOT NULL DEFAULT "1"',
            ], $tableOptions);
            $this->createIndex('CI_content_catalog', 'catalog_content', 'id_catalog');
            $this->createIndex('CI_content_subcatalog', 'catalog_content', 'id_subcatalog');



            $this->createTable('product_price', [
                'id' => $this->primaryKey(),
                'image' => 'INT(11) NOT NULL DEFAULT "0"',
                'name' => 'VARCHAR(255) NOT NULL',
                'cost' => 'INT(11) NOT NULL DEFAULT "0"',
                'sort' => 'INT(11) NOT NULL DEFAULT "1"',
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
            $table_to_check = Yii::$app->db->schema->getTableSchema('catalog');
            if (is_object($table_to_check)) {
                $this->dropTable('catalog');
            }
            $table_to_check = Yii::$app->db->schema->getTableSchema('subcatalog');
            if (is_object($table_to_check)) {
                $this->dropTable('subcatalog');
            }
            $table_to_check = Yii::$app->db->schema->getTableSchema('catalog_content');
            if (is_object($table_to_check)) {
                $this->dropTable('catalog_content');
            }
            $table_to_check = Yii::$app->db->schema->getTableSchema('product_price');
            if (is_object($table_to_check)) {
                $this->dropTable('product_price');
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
