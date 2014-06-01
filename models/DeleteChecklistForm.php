<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Checklist;

/**
 * LoginForm is the model behind the login form.
 */
class DeleteChecklistForm extends Model
{
    public $id;    

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['id', 'integer'],
        ]; 
    }   
    
    public function deleteChecklist()
    {
        if ($this->validate()) {
        	echo $this->id;
        	$list = Checklist::findOne($this->id);	
			
            return $list->delete();           
        } else {
            return false;
        }
    }    
}
