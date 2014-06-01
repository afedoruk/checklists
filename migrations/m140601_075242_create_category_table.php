<?php

use yii\db\Schema;

class m140601_075242_create_category_table extends \yii\db\Migration
{
    public function up()
    {
		$this->createTable('category', [
            'id' => 'pk',
            'title' => 'string',            
        ]);
    }

    public function down()
    {
		$this->dropTable('category');
    }
}
