<?php
namespace frontend\widgets\hot;

/**
 * 热门浏览组件
 */
use Yii;
use yii\base\Widget;
use common\models\Post;
use yii\helpers\Url;
use common\models\PostExtends;
use yii\db\Query;

class HotWidget extends Widget
{
    public $title = '';
    
    public $limit = 8;
    
    public $more = true;
    
    public $page = true;
    
    public function run()
    {
        $res = (new Query())
            ->select('a.browser, b.id, b.title')
            ->from(['a'=>PostExtends::tableName()])
            ->join('LEFT JOIN',['b'=>Post::tableName()],'a.post_id = b.id')
            ->where('b.is_valid ='.Post::IS_VALID)
            ->orderBy('browser DESC, id DESC')
            ->limit($this->limit)
            ->all();
        
        $result['title'] = $this->title?:'热门浏览';
        $result['more'] = Url::to(['post/index','sort'=>'hot']);
        $result['body'] = $res?:[];
        
        return $this->render('index',['data'=>$result]);
    }
}