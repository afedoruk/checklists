<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Item;

/**
 * LoginForm is the model behind the login form.
 */
class ItemForm extends Model
{
    public $title;
    public $description;

    public function rules()
    {
        return [
            [['title'], 'required'],                        
            //['rememberMe', 'boolean'],      
            
        ];
    }   
    
    public function createItem()
    {
        if ($this->validate()) {
        	$item = new Item();
			$item->title=$this->title;
			$item->description=$this->description;
			//$item->user_id=Yii::$app->user->identity->id;			 
            return $item->save();           
        } else {
            return false;
        }
    }    
}
