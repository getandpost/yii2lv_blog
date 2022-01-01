<?php

/* @var $this yii\web\View */
/* @var $model \frontend\models\UserForm */
$this->title = Yii::t('common', 'User Profile');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
	<div class="col-lg-9">
		<div class="page-title">
			<h1>基本信息</h1>
		</div>
		<div class="page-content">
			<p>用户名：<?=$data['username']?></p>
			<p>邮箱：<?=$data['email']?></p>
		</div>
	</div>
</div>
