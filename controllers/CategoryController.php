<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Category;

class CategoryController extends Controller
{  
    
    public function actionIndex()
    {
    	$categories = Category::find()->orderBy('title')->all();
	
        return $this->render('index', ['categories'=>$categories]);
    }
	
	public function actionView($id)
	{
		$category=Category::findOne($id);		
		return $this->render('view', ['category'=>$category]);
	}	
}
