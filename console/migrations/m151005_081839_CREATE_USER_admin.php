<?php

use yii\db\Migration;

class m151005_081839_CREATE_USER_admin extends Migration
{
	public $tableUser = '{{%user}}';
	public $tableAuthAssignment = '{{%auth_assignment}}';
	public $tableAuthItem = '{{%auth_item}}';
	public $tableAuthItemChild = '{{%auth_item_child}}';

    public function up()
    {
		try {

			$this->insert($this->tableUser, [
				'id' => 1,
				'username' => 'belyaev',
				'auth_key' => 'z2IUCXeGmXQZpxr6hEfARj5zUcgFNKSl',
				'password_hash' => '$2y$13$uP.BvhjFqZX.mtub4ibqZe2c6QadFrfhBSTjuvujcdv8MrQDX4/Nu',
				'status' => 10,
				'created_at' => 1443542022,
				'updated_at' => 1443778337
			]);



			$this->insert($this->tableAuthItem, [
				'name' => 'Administrator',
				'type' => 1,
				'description' => 'Имеет полный доступ',
				'rule_name' => NULL,
				'data' => NULL,
				'created_at' => 1443793270,
				'updated_at' => 1443794028
			]);

			$this->insert($this->tableAuthItem, [
				'name' => 'Moderator',
				'type' => 1,
				'description' => 'Может редактировать контент сайта',
				'rule_name' => NULL,
				'data' => NULL,
				'created_at' => 1443793336,
				'updated_at' => 1443794046
			]);


			$this->insert($this->tableAuthAssignment, [
				'item_name' => 'Administrator',
				'user_id' => '1',
				'created_at' => 1443793369,
			]);

			$this->insert($this->tableAuthAssignment, [
				'item_name' => 'Moderator',
				'user_id' => '8',
				'created_at' => 1443793376,
			]);

		} catch (Exception $e) {
			echo 'Exception: ',  $e->getMessage(), "\n";
			$this->down();
			return false;
		}
    }

    public function down()
    {
		try {
			$table_to_check = \Yii::$app->db->schema->getTableSchema($this->tableUser);
			if (is_object($table_to_check)){
				$this->delete($this->tableUser, ['id' => 1]);
			}

			$table_to_check = \Yii::$app->db->schema->getTableSchema($this->tableAuthAssignment);
			if (is_object($table_to_check)){
				$this->delete($this->tableAuthAssignment, ['item_name' => 'Administrator']);
				$this->delete($this->tableAuthAssignment, ['item_name' => 'Moderator']);
			}

			$table_to_check = \Yii::$app->db->schema->getTableSchema($this->tableAuthItem);
			if (is_object($table_to_check)){
				$this->delete($this->tableAuthItem, ['name' => 'Administrator']);
				$this->delete($this->tableAuthItem, ['name' => 'Moderator']);
			}

		} catch (Exception $e) {
			echo 'Exception while down ',  $e->getMessage(), "\n";
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
