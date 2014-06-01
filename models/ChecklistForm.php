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
	public $id = null;
    public $title;
    public $description;
    public $private = true;
	public $rawItems;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['title', 'required'],
            ['description', 'string'],                        
            ['private', 'boolean'],      
          	['rawItems', 'string']  
        ];
    }   
    
    public function createChecklist()
    {
        if ($this->validate()) {
        	if($this->id) {
        		$list = Checklist::findOne($this->id);	
        	} else {
        		$list = new Checklist();
			}			
			$list->title=$this->title;
			$list->description=$this->description;
			$list->private=$this->private;			
			$list->rawItems=$this->rawItems;			
			$list->user_id=Yii::$app->user->identity->id;			 
            return $list->save();           
        } else {
            return false;
        }
    }	
	    
}
