<?php

namespace common\models;

use Yii;
use common\models\base\Base;

/**
 * This is the model class for table "auth".
 *
 * @property int $id 自增ID
 * @property int $user_id 用户ID
 * @property string $source 来源
 * @property string $source_id 来源ID
 */
class Auth extends Base
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['source_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'source' => 'Source'
        ];
    }
}
