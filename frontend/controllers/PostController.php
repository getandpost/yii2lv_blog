<?php
namespace frontend\controllers;

/**
 * 文章控制器
 */
use Yii;
use frontend\controllers\base\BaseController;

class PostController extends BaseController
{

    /**
     * 文章列表
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}