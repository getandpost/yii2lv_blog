<?php

namespace frontend\widgets\clustrmaps;

/**
 * clustrmaps组件
 */

use yii\base\Widget;

class ClustrmapsWidget extends Widget
{
    public function run()
    {
        $data = [
            'title' => '访客地图'
        ];
        return $this->render('index', ['data' => $data]);
    }
}