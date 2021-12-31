<?php

namespace frontend\widgets\search;

/**
 * 搜索组件
 */

use yii\base\Widget;

class SearchWidget extends Widget
{
    public function run()
    {
        $data = [];
        return $this->render('index', ['data' => $data]);
    }
}