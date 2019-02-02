<?php
namespace frontend\controllers;

/**
 * 文章控制器
 */
use Yii;
use frontend\controllers\base\BaseController;
use frontend\models\PostForm;
use common\models\Cats;

class PostController extends BaseController
{

    public function actions()
    {
        return [
            'upload'=>[
                'class' => 'common\widgets\file_upload\UploadAction',     //这里扩展地址别写错
                'config' => [
                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}",
                ]
            ]
        ];
    }
    
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
        $cat = Cats::getAllCats();
        return $this->render('create', [
            'model' => $model,
            'cat' => $cat,
        ]);
    }
}