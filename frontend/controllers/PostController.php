<?php
namespace frontend\controllers;

/**
 * 文章控制器
 */
use Yii;
use frontend\controllers\base\BaseController;
use frontend\models\PostForm;

class PostController extends BaseController
{

    /**
     * 文章列表
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    /**
     * 创建文章
     * @return string
     */
    public function actionCreate()
    {
        $model = new PostForm();
        return $this->render('create', [
            'model' => $model,
        ]);
    }
}