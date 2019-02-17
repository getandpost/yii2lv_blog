<?php

namespace common\models;

use Yii;
use common\models\base\Base;

/**
 * This is the model class for table "cats".
 *
 * @property int $id 自增ID
 * @property string $cat_name 分类名称
 * @property int $created_at 创建时间
 * @property int $updated_at 修改时间
 */
class Cats extends Base
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cats';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cat_name', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['cat_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat_name' => '分类名称',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
    
    /**
     * 获取所有分类
     */
    public static function getAllCats()
    {
        $cat = ['0' => '暂无分类'];
        $res = self::find()->asArray()->all();
        if ($res) {
            $cat = ['0' => '请选择'];
            foreach ($res as $k => $list) {
                $cat[$list['id']] = $list['cat_name'];
            }
        }
        return $cat;
    }
}
