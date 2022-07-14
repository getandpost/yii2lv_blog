<?php

use yii\base\Widget;
use frontend\widgets\banner\BannerWidget;
use frontend\widgets\post\PostWidget;
use frontend\widgets\chat\ChatWidget;
use frontend\widgets\hot\HotWidget;
use frontend\widgets\tag\TagWidget;
use frontend\widgets\search\SearchWidget;
use frontend\widgets\clustrmaps\ClustrmapsWidget;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = '博客－首页';
?>
<div class="row">
    <div class="col-lg-9">
        <!-- 图片轮播 -->
        <?= BannerWidget::widget() ?>

        <!-- 文章列表 -->
        <?= PostWidget::widget() ?>
    </div>
    <div class="col-lg-3">
        <!-- 搜索 -->
        <?= SearchWidget::widget() ?>

        <!-- 留言板 -->
        <?= ChatWidget::widget() ?>

        <!-- 热门浏览 -->
        <?= HotWidget::widget() ?>

        <!-- 标签云 -->
        <?= TagWidget::widget() ?>

        <!--访客地图-->
        <?= ClustrmapsWidget::widget() ?>
    </div>
</div>
