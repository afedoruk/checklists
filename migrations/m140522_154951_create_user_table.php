<?php

use yii\db\Schema;

class m140522_154951_create_user_table extends \yii\db\Migration
{
    public function up()
    {
		$this->createTable('user', [
            'id' => 'pk',
            'username' => 'string(50) NOT NULL',
            'auth_key' => 'string',
            'email' => 'string(128)',
            'phash' => 'string',
            'created_at' => 'timestamp',
            'updated_at' => 'timestamp',
        ]);

    }

    public function down()
    {
        $this->dropTable('user');
    }
}
