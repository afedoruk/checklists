<?php

namespace app\models;
use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
	
  	public static function tableName()
    {
        return 'category';
    }
	
	public function getChecklists()
    {
        return $this->hasMany(Checklist::className(), ['category_id' => 'id'])->inverseOf('category');
    }
	
	public function getAll()
	{
		$categories=array();
		$cats=Category::find()->asArray()->all();
		foreach($cats as $cat) {
			$categories[$cat['id']]=$cat['title'];
		}
		
		return $categories;
	}
	
}
