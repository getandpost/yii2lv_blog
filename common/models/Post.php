<?php
namespace common\models;

use Yii;
use common\models\base\Base;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $title
 * @property string $summary
 * @property string $content
 * @property string $label_img
 * @property integer $cat_id
 * @property integer $user_id
 * @property string $user_name
 * @property integer $is_valid
 * @property integer $created_at
 * @property integer $updated_at
 */
class Post extends Base
{
    const IS_VALID = 1; // 发布
    const NO_VALID = 0; // 未发布
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts';
    }

    public function getRelate()
    {
        return $this->hasMany(RelationPostTags::className(), ['post_id' => 'id']);
    }
    
    public function getExtend()
    {
        return $this->hasOne(PostExtends::className(), ['post_id' => 'id']);
    }
    
    public function getCat()
    {
        return $this->hasOne(Cats::className(), ['id' => 'cat_id']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['cat_id', 'user_id', 'is_valid', 'created_at', 'updated_at'], 'integer'],
            [['title', 'summary', 'label_img', 'user_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'summary' => 'Summary',
            'content' => 'Content',
            'label_img' => 'Label Img',
            'cat_id' => 'Cat ID',
            'user_id' => 'User ID',
            'user_name' => 'User Name',
            'is_valid' => 'Is Valid',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At'
        ];
    }
}
