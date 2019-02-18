<?php
use yii\helpers\Url;
?>

<div class="panel">
  <!-- 留言板 -->
  <div class="panel-title box-title">
     <span><strong>留言板</strong></span>
  </div>

  <div class="panel-body">
     <form action="/" id="w0" method="post">
         <div class="form-group input-group field-feed-content required">
             <textarea id="feed-content" class="form-control" name="content" placeholder="我的留言" rows="" cols=""></textarea>
             <span class="input-group-btn">
                 <button type="button" data-url="<?=Url::to(['site/add-feed'])?>" class="btn btn-primary j-feed"" style="width: auto;height:52px;margin-top:-1px">发表</button>
             </span>
         </div>
     </form>
     <?php if (!empty($data['feed'])):?>
         <ul class="media-list media-feed feed-index ps-container ps-active-y">
             <?php foreach ($data['feed'] as $list):?>
                 <li class="media">
                     <div class="media-left"><a href="#" rel="author" data-original-title="" title="">
                             <img alt="" class="avatar-img" style="width:37px;height:37px;" src="statics/images/avatar/small.jpg"/></a></div>
                     <div class="media-body">
                         <div class="media-content">
                             <a href="#" ><?=$list['user']['username']?>: </a>
                             <span><?=$list['content']?></span>
                         </div>
                         <div class="media-action">
                             <?=date('Y-m-d h:i:s',$list['created_at'])?>
                         </div>
                     </div>

                 </li>
             <?php endforeach;?>
         </ul>
     <?php endif;?>
  </div>
</div>