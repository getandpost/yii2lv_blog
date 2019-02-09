<?php
namespace frontend\models;

/**
 * 文章表单模型
 */
use Yii;
use yii\base\Model;
use common\models\Post;
use common\models\RelationPostTags;
use yii\db\Query;
use yii\web\NotFoundHttpException;

class PostForm extends Model
{
    public $id;
    public $title;
    public $content;
    public $label_img;
    public $cat_id;
    public $tags;
    
    public $_lastError = "";
    
    /**
     * 定义场景
     * SCENARIOS_CREATE 创建
     * SCENARIOS_UPDATE 更新
     * @var string
     */
    const SCENARIOS_CREATE = 'create';
    const SCENARIOS_UPDATE = 'update';
    
    /**
     * EVENT_AFTER_CREATE 创建之后的事件
     * EVENT_AFTER_UPDATE 更新之后的事件
     * @var string
     */
    const EVENT_AFTER_CREATE = 'eventAfterCreate';
    const EVENT_AFTER_UPDATE = 'eventAfterUpdate';
    
    /**
     * 场景设置
     * @see \yii\base\Model::scenarios()
     */
    public function scenarios()
    {
        $scenarios = [
            self::SCENARIOS_CREATE => ['title', 'content', 'label_img', 'cat_id', 'tags'],
            self::SCENARIOS_UPDATE => ['title', 'content', 'label_img', 'cat_id', 'tags']
        ];
        return array_merge(parent::scenarios(), $scenarios);
    }
    public function rules()
    {
        return [
            [['id', 'title', 'content', 'cat_id'], 'required'],
            [['id', 'cat_id'], 'integer'],
            ['title', 'string', 'min' => 4, 'max' => 50],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'title' => '标题',
            'content' => '内容',
            'label_img' => '标签图',
            'tags' => '标签',
            'cat_id' => '分类',
        ];
    }
    
    public function create()
    {
        // 事务
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model = new Post();
            $model->setAttributes($this->attributes);
            $model->summary = $this->_getSummary();
            $model->user_id = Yii::$app->user->identity->id;
            $model->user_name = Yii::$app->user->identity->username;
            $model->is_valid = Post::IS_VALID;
            $model->created_at = time();
            $model->updated_at = time();
            if (!$model->save()) {
                throw new \Exception('文章保存失败！');
            }
            $this->id = $model->id;
            
            // 调用事件
            $data = array_merge($this->getAttributes(), $model->getAttributes());
            $this->_eventAfterCreate($data);
            
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            $this->_lastError = $e->getMessage();
            return false;
        }
    }
    
    public function getViewById($id)
    {
        $res = Post::find()->with('relate.tag', 'extend')->where(['id'=>$id])->asArray()->one();
        if (!$res) {
            throw new NotFoundHttpException('文章不存在！');
        }
        // 处理标签格式
        $res['tags'] = [];
        if (isset($res['relate']) && !empty($res['relate'])) {
            foreach ($res['relate'] as $list) {
                $res['tags'][] = $list['tag']['tag_name'];
            }
        }
        unset($res['relate']);
        return $res;
    }
    
    /**
     * 截取文章摘要
     * @param number $s
     * @param number $e
     * @param string $char
     * @return NULL|string
     */
    private function _getSummary($s = 0, $e = 90, $char = 'utf-8')
    {
        if (empty($this->content)) {
            return null;
        }
        return (mb_substr(str_replace('&nbsp;', '', strip_tags($this->content)), $s, $e, $char));
    }
    
    /**
     * 创建完成后调用的事件方法
     */
    public function _eventAfterCreate($data)
    {
        $this->on(self::EVENT_AFTER_CREATE, [$this, '_eventAddTag'], $data);
        // 触发事件
        $this->trigger(self::EVENT_AFTER_CREATE);
    }
    
    /**
     * 添加标签
     */
    public function _eventAddTag($event)
    {
        // 保存标签
        $tag = new TagForm();
        $tag->tags = $event->data['tags'];
        $tagids = $tag->saveTags();
        
        // 删除原先的关联关系
        RelationPostTags::deleteAll(['post_id' => $event->data['id']]);
        
        // 批量保存文章标签的关联关系
        if (!empty($tagids)) {
            $rows = [];
            foreach ($tagids as $k=>$id) {
                $rows[$k]['post_id'] = $this->id;
                $rows[$k]['tag_id'] = $id;
            }
            
            $res = (new Query())->createCommand()
                ->batchInsert(RelationPostTags::tableName(), ['post_id', 'tag_id'], $rows)
                ->execute();
            if (!$res) {
                throw new \Exception("关联关系保存失败！");
            }
        }
    }
}