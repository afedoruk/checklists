<?php

namespace app\models;
use yii\db\ActiveRecord;

class Item extends ActiveRecord
{
	
  	public static function tableName()
    {
        return 'item';
    }
	
	public function getChecklist()
    {
        return $this->hasOne(Checklist::className(), ['id' => 'checklist_id']);
    }
	
	public function deleteChecklistItems($list_id)
	{
		Item::deleteAll('checklist_id = :list_id', [':list_id' => $list_id]);
	}
	
	public function doneChecklistItems($list_id, $ids)
	{
		Item::updateAll(['status' => 0], 'checklist_id = :list_id', [':list_id' => $list_id]);
		Item::updateAll(['status' => 1], ['in', 'id', $ids]);
	}
}
