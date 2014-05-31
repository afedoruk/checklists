<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Checklist;

/**
 * LoginForm is the model behind the login form.
 */
class ChecklistForm extends Model
{
    public $title;
    public $description;
    //public $rememberMe = true;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],                        
            //['rememberMe', 'boolean'],      
            
        ];
    }   
    
    public function createChecklist()
    {
        if ($this->validate()) {
        	$list = new Checklist();
			$list->title=$this->title;
			$list->descript=$this->description;			
			$list->user_id=Yii::$app->user->identity->id;			 
            return $list->save();           
        } else {
            return false;
        }
    }    
}
