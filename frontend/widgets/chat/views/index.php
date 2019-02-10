<?php
use yii\helpers\Url;
?>
<!-- 只言片语 -->
<div class="panel-title box-title">
	<span><strong>只言片语</strong></span>
	<span class="pull-right"><a href="#" class="font-12">更多》</a></span>
</div>
<div class="panel-body">
<form id="w0" action="/" method="post">
	<div class="form-group input-group field-feed-content required">
		<textarea id="feed-content" class="form-control" name="content" placeholder="我的留言" rows="" cols=""></textarea>
		<span class="input-group-btn">
			<button type="button" data-url="<?=Url::to(['site/add-feed'])?>" class="btn">发布</button>
		</span>
	</div>
</form>
<?php if (!empty($data['feed'])):?>
<ul class="media-list media-feed feed-index ps-container ps-active-y">
	<?php foreach ($data['feed'] as $list):?>
	<li class="media">
		
	</li>
	<?php endforeach;?>
</ul>
<?php endif;?>
</div>