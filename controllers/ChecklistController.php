<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\ChecklistForm;
use app\models\Checklist;

class ChecklistController extends Controller
{
	/*
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
*/
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
		 
         return $this->render('view', ['list' => $list,]);        
    }
}
