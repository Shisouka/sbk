<?php

use yii\db\Migration;

class m161107_072830_USERS_EMAIL_NULL extends Migration
{
    public $tableName = 'user';

    public function up()
    {
        try {

            $this->alterColumn($this->tableName, 'email',  \yii\db\mysql\Schema::TYPE_STRING . '(255) NULL');

        } catch (Exception $e) {
            echo 'Exception: ',  $e->getMessage(), "\n";
            $this->down();
            return false;
        }
    }

    public function down()
    {
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
