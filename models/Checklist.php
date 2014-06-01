<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;

class Checklist  extends ActiveRecord
{
	public $rawItems;
	
  	public static function tableName()
    {
        return 'checklist';
    }
	
	public function isOwner($user_id=null)
	{
		if($user_id) {
			return $this->user_id==$user_id;
		} else {
			return $this->user_id==Yii::$app->user->identity->id;
		}
	}
	
	public function getItems()
    {
        return $this->hasMany(Item::className(), ['checklist_id' => 'id'])->inverseOf('checklist');
    }
	
	public function afterSave($insert)
	{		
    	parent::afterSave($insert);
		$this->deleteItems();    		
		$rawItems=explode("\n", $this->rawItems);		
    	foreach($rawItems as $rawItem) {
    		if($rawItem)) {
	    		$item = new Item();
				$item->title = $rawItem;				
				$this->link('items', $item);
			}
    	}
        return true;
    	
	}
	
	public function afterDelete()
	{		
    	parent::afterDelete();
		$this->deleteItems();
        return true;    	
	}
	
	public function deleteItems()
	{
		Item::deleteChecklistItems($this->id);	
	}
}
