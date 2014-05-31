<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\ChecklistForm;
use app\models\Checklist;
use app\models\ItemForm;

class ChecklistController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create'],
                'rules' => [
                    [
                        'actions' => ['create'],
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

    public function actionIndex()
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
	//TODO:проверка принадлежности и приватности
	public function actionView($id)
    {
    	 $list = Checklist::findOne($id);         
		 $model = new ItemForm();
		  if ($model->load(Yii::$app->request->post()) && $model->createItem()) {
            return $this->goBack();
          } 
          else {
            return $this->render('view', ['list' => $list,]). $this->render('create', [
                'model' => $model,
            ]);
          }        
    }
}
