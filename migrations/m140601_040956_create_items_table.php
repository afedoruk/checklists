<?php

use yii\db\Schema;

class m140601_040956_create_items_table extends \yii\db\Migration
{
    public function up()
    {
		$this->createTable('item', [
            'id' => 'pk',
            'title' => 'string',
            'description' => 'text',            
            'status' => 'boolean',
            'checklist_id' => 'integer',            
            'user_id' => 'integer',
        ]);
    }

    public function down()
    {
        $this->dropTable('checklist');
    }
}
