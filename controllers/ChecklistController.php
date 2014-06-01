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
            return $this->goBack();
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
		 
		 $model = new DeleteChecklistForm();
		 $model->id=$list->id;
		 
        if ($model->load(Yii::$app->request->post()) && $model->deleteChecklist()) {
            return $this->redirect(['checklist/my']);;
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
	/* $model = new ItemForm();*/
		  /*if ($model->load(Yii::$app->request->post()) && $model->createItem()) {
            return $this->goBack();
          } 
          else {*/
            return $this->render('view', ['list' => $list, 'is_owner'=> $list->user_id == Yii::$app->user->identity->id]);//. $this->render('create', [
             //   'model' => $model,
            //]);
          //}        
		 } else {		 	
		 	throw new \yii\web\ForbiddenHttpException('You don\'t have right to view this list.');		 
		 }
    }
}
