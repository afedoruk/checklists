<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\ChecklistForm;
use app\models\DeleteChecklistForm;
use app\models\Checklist;
//use app\models\ItemForm;

class ChecklistController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'my'],
                'rules' => [
                    [
                        'actions' => ['create', 'my'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],                    
                ],
            ],            
        ];
    }
/*
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }*/
    
    
	//TODO тут предполагаются все списки или какие-нибудь там featured списки
    public function actionIndex()
    {
    	$lists = Checklist::findAll(['user_id'=>Yii::$app->user->identity->id]);
	
        return $this->render('index', ['lists'=>$lists]);
    }
	
	public function actionMy()
    {
    	$lists = Checklist::findAll(['user_id'=>Yii::$app->user->identity->id]);
	
        return $this->render('index', ['lists'=>$lists]);
    }
	
	public function actionCreate()
    {
         $model = new ChecklistForm();
		 
        if ($model->load(Yii::$app->request->post()) && $model->createChecklist()) {
            return $this->redirect(['checklist/my']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

	public function actionDelete($id)
    {         
		 $list = Checklist::findOne($id);
		 if($list->isOwner()) {
		 
		 $model = new ChecklistForm();
		 $model->id=$list->id;
		 $model->scenario = 'delete';
		 
        if ($model->load(Yii::$app->request->post()) && $model->deleteChecklist()) {
            return $this->redirect(['checklist/my']);
        } else {
            return $this->render('delete', [
                'model' => $model, 'list' => $list
            ]);
        }
		 }
		 else {
			 throw new \yii\web\ForbiddenHttpException('You don\'t have right to delete this list.');
		 }
    }
		
	public function actionView($id)
    {
    	 $list = Checklist::findOne($id);         
		 if(!$list->private || $list->isOwner()) {
		 	$model = new ChecklistForm();
			$model->id=$list->id;
			$model->scenario='doneItems';
			foreach($list->items as $item)
			{				
				$model->items[$item->id]=$item->title;
				if($item->status)
					$model->status[]=$item->id;
			} 
			if ($model->load(Yii::$app->request->post()) && $model->doneItems()) {
            	return $this->redirect(['checklist/view', 'id'=>$id]);
        	} else {
            	return $this->render('view', ['list' => $list, 'model'=> $model]);
			}
		 } else {		 	
		 	throw new \yii\web\ForbiddenHttpException('You don\'t have right to view this list.');		 
		 }
    }
	
	public function actionEdit($id)
    {         
		 $list = Checklist::findOne($id);
		 if($list->isOwner()) {
		 
		 $model = new ChecklistForm();
		 $model->id=$list->id;
		 $model->title=$list->title;
		 $model->description=$list->description;
		 $model->private=$list->private;
		 
		 $rawItems=[];
		 foreach($list->items as $item) {
		 	$rawItems[]=$item->title;
		 }
		 $model->rawItems=implode("\n", $rawItems);
		 
        if ($model->load(Yii::$app->request->post()) && $model->createChecklist()) {
            return $this->redirect(['checklist/view', 'id'=>$id]);;
        } else {
            return $this->render('create', [
                'model' => $model, 'list' => $list
            ]);
        }
		 }
		 else {
			 throw new \yii\web\ForbiddenHttpException('You don\'t have right to edit this list.');
		 }
    }
	
	public function actionClone($id)
    {         
		 $list = Checklist::findOne($id);
		 if($list->isOwner()) {
		 
		 $model = new ChecklistForm();
		 $model->parent_id=$list->id;
		 $model->title=$list->title;
		 $model->description=$list->description;
		 $model->private=$list->private;
		 
		 $rawItems=[];
		 foreach($list->items as $item) {
		 	$rawItems[]=$item->title;
		 }
		 $model->rawItems=implode("\n", $rawItems);
		 
        if ($model->load(Yii::$app->request->post()) && $model->createChecklist()) {
            return $this->redirect(['checklist/view', 'id'=>$id]);;
        } else {
            return $this->render('create', [
                'model' => $model, 'list' => $list
            ]);
        }
		 }
		 else {
			 throw new \yii\web\ForbiddenHttpException('You don\'t have right to clone this list.');
		 }
    }
}
