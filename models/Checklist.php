<?php

namespace app\models;
use yii\db\ActiveRecord;

class Checklist  extends ActiveRecord
{
	
  	public static function tableName()
    {
        return 'checklist';
    }
}
