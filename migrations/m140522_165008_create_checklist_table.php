<?php

use yii\db\Schema;

class m140522_165008_create_checklist_table extends \yii\db\Migration
{
    public function up()
    {
		$this->createTable('checklist', [
            'id' => 'pk',
            'title' => 'string',
            'description' => 'text',
            'created_at' => 'timestamp',
            'updated_at' => 'timestamp',
            'private' => 'boolean',
            'category_id' => 'integer',
            'parent_id' => 'integer',
            'user_id' => 'integer',
        ]);
    }

    public function down()
    {
        $this->dropTable('checklist');
    }
}
