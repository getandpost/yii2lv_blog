<?php
namespace frontend\widgets\chat;

/**
 * 留言板组件
 */
use Yii;
use yii\base\Widget;
use frontend\models\FeedsForm;

class ChatWidget extends Widget
{
    public function run()
    {
        $feed = new FeedsForm();
        $data['feed'] = $feed->getList();
        return $this->render('index', ['data'=>$data]);
    }
}