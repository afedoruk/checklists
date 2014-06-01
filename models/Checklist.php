<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;

class Checklist  extends ActiveRecord
{
	
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
}
