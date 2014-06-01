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
    public $private = true;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['title', 'required'],
            ['description', 'string'],                        
            ['private', 'boolean'],      
            
        ];
    }   
    
    public function createChecklist()
    {
        if ($this->validate()) {
        	$list = new Checklist();
			$list->title=$this->title;
			$list->description=$this->description;
			$list->private=$this->private;			
			$list->user_id=Yii::$app->user->identity->id;			 
            return $list->save();           
        } else {
            return false;
        }
    }    
}
