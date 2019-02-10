<?php
namespace frontend\widgets\tag;

/**
 * 标签云组件
 */
use Yii;
use yii\bootstrap\Widget;
use common\models\Tags;

class TagWidget extends Widget
{

    public $title = '';

    public $limit = 10;

    public function run()
    {
        $res = Tags::find()->orderBy(['post_num' => SORT_DESC])
            ->limit($this->limit)
            ->all();
        $result['title'] = $this->title?:'标签云';
        $result['body'] = $res?:[];
        
        return $this->render('index', ['data' => $result]);
    }
}