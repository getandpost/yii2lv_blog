<?php

namespace common\models;

use Yii;
use common\models\base\Base;

/**
 * This is the model class for table "tags".
 *
 * @property int $id 自增ID
 * @property string $tag_name 标签名称
 * @property int $post_num 关联文章数
 */
class Tags extends Base
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_num'], 'integer'],
            [['tag_name'], 'string', 'max' => 255],
            [['tag_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag_name' => 'Tag Name',
            'post_num' => 'Post Num',
        ];
    }
}
