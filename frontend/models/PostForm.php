<?php
namespace frontend\models;

/**
 * 文章表单模型
 */
use Yii;
use yii\base\Model;
use common\models\Post;

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
            $this->_eventAfterCreate();
            
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            $this->_lastError = $e->getMessage();
            return false;
        }
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
    private function _eventAfterCreate()
    {
        
    }
}