<?php
namespace frontend\models;

/**
 * 文章表单模型
 */
use Yii;
use yii\base\Model;

class PostFrom extends Model
{
    public $id;
    public $title;
    public $content;
    public $label_img;
    public $cate_id;
    public $tags;
    
    public $_lastError = "";
    
    public function rules()
    {
        return [
            [['id', 'title', 'content', 'cat_id'], 'required'],
            ['id', 'cat_id', 'integer'],
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
        ];
    }
}