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
	public $parent_id = null;
	public $category_id;
    public $title;
    public $description;
    public $private = true;
	public $rawItems;
	public $status;
	public $items;
	public $categories;

    /**
     * @return array the validation rules.
     */
     
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['doneItems'] = ['id', 'status', 'items'];
		$scenarios['delete'] = ['id'];     
        return $scenarios;
    }    
	
    public function rules()
    {
        return [        	
        	['category_id', 'integer'],
        	['category_id', 'required'],
            ['title', 'required'],
            ['description', 'string'],                        
            ['private', 'boolean'],      
          	['rawItems', 'string'],
          	['status', 'safe']
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
			$list->parent_id=$this->parent_id;
			$list->title=$this->title;
			$list->description=$this->description;
			$list->category_id=$this->category_id;
			$list->private=$this->private;			
			$list->rawItems=$this->rawItems;			
			$list->user_id=Yii::$app->user->identity->id;			 
            return $list->save();           
        } else {
            return false;
        }
    }	
	
	public function doneItems()
	{		
		 if ($this->validate()) {	     	   		
        	$list = Checklist::findOne($this->id);        		 
            return $list->doneItems($this->status);           
        } else {
            return false;
        }
	}
	
	public function deleteChecklist()
    {
        if ($this->validate()) {        	
        	$list = Checklist::findOne($this->id);	
			
            return $list->delete();           
        } else {
            return false;
        }
    }    
	    
}
