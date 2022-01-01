<?php
namespace frontend\controllers;

/**
 * 用户控制器
 */
use Yii;
use frontend\controllers\base\BaseController;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\models\Post;
use frontend\models\UserForm;

class UserController extends BaseController
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['profile'],
                'rules' => [
                    [
                        'actions' => ['profile'],
                        'allow' => true,
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '*' => ['get', 'post'],
                ],
            ],
        ];
    }
    
    public function actions()
    {
        return [];
    }
    
    /**
     * 个人中心
     */
    public function actionProfile()
    {
        $model = new UserForm();
        $id = Yii::$app->user->identity->id;
        $data = $model->getViewById($id);
        
        return $this->render('profile', [
            'data' => $data
        ]);
    }
}