<?php
namespace frontend\widgets\banner;

/**
 * Banner组件
 */
use Yii;
use yii\base\Widget;

class BannerWidget extends Widget
{
    public $items = [];
    
    public function init()
    {
        if (empty($this->items)) {
            $this->items = [
                ['label' => 'demo', 'image_url' => 'statics/images/banner/b_0.png', 'url' => ['site/index'], 'html' => '', 'active' => 'active'],
                ['label' => 'demo', 'image_url' => 'statics/images/banner/b_0.png', 'url' => ['site/index'], 'html' => ''],
                ['label' => 'demo', 'image_url' => 'statics/images/banner/b_0.png', 'url' => ['site/index'], 'html' => ''],
            ];
        }
    }
    
    public function run()
    {
        $data['items'] = $this->items;
        return $this->render('index', ['data' => $data]);
    }
}