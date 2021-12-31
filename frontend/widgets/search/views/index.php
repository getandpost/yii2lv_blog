<?php
use yii\helpers\Url;
?>

<div class="panel">
  <!-- 搜索 -->
  <div class="panel-body">
     <form action="/" id="w0" method="post">
         <div class="form-group input-group field-search-content required">
             <input id="search-content" class="form-control" name="keyword" placeholder="搜索..." rows="" cols="" />
             <span class="input-group-btn">
                 <button type="button" data-url="<?=Url::to(['post/index'])?>" class="btn btn-primary j-search"><i class="fa fa-search"></i></button>
             </span>
         </div>
     </form>
  </div>
</div>