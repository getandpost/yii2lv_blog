<?php

use frontend\widgets\banner\BannerWidget;
use yii\base\Widget;
use frontend\widgets\post\PostWidget;

/* @var $this yii\web\View */

$this->title = '博客－首页';
?>
<div class="row">
	<div class="col-lg-9">
		<?=BannerWidget::widget()?>
	</div>
	<div class="col-lg-3">
	</div>
	<div class="col-lg-9>
		<!-- 文章列表 -->
		<?=PostWidget::widget()?>
	</div>
</div>
