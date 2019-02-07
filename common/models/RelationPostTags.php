<?php

namespace common\models;

use Yii;
use common\models\base\Base;

/**
 * This is the model class for table "relation_post_tags".
 *
 * @property int $id 自增ID
 * @property int $post_id 文章ID
 * @property int $tag_id 标签ID
 */
class RelationPostTags extends Base
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'relation_post_tags';
    }

    public function getTag()
    {
        return $this->hasOne(Tags::className(), ['id' => 'tag_id']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id', 'tag_id'], 'integer'],
            [['post_id', 'tag_id'], 'unique', 'targetAttribute' => ['post_id', 'tag_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'tag_id' => 'Tag ID',
        ];
    }
}
