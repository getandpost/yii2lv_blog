<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PostForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '创建';
$this->params['breadcrumbs'][] = ['label' => '文章', 'url' => ['post/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
  <div class="col-lg-9">
    <div class="panel-title box-title">
      <span>创建文章</span>
    </div>
    <div class="panel-body">
      <?php $form = ActiveForm::begin();?>
      
      <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
      
      <?= $form->field($model, 'cat_id')->dropDownList($cat) ?>
              
      <?= $form->field($model, 'label_img')->widget('common\widgets\file_upload\FileUpload', [
        'config' => []
      ]) ?>
      
      <?= $form->field($model, 'content')->widget('common\widgets\ueditor\Ueditor', [
        'options'=>[
            'initialFrameHeight' => 400,
        ]
      ]) ?>
      
      <?= $form->field($model, 'tags')->widget('common\widgets\tags\TagWidget') ?>
      
      <div class="form-group">
        <?= Html::submitButton("发布", ['class'=>'btn btn-success']) ?>
      </div>
      
      <?php ActiveForm::end()?>
    </div>
  </div>
  <div class="cl-lg-3">
    <div class="panel-title box-title">
      <span>注意事项</span>
    </div>
    <div class="panel-body">
      <p>1.xxxx</p>
      <p>2.xxxx</p>
    </div>
  </div>
</div>