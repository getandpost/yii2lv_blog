<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use yii\web\NotFoundHttpException;

/**
 * User form
 */
class UserForm extends Model
{
    public $username;
    public $email;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 16],
            ['username', 'match', 'pattern' => '/^[(\x{4E00}-\x{9FA5})a-zA-Z]+[(\x{4E00}-\x{9FA5})a-zA-Z_\d]*$/u', 'message' => '用户名由字母，汉字，数字，下划线组成，且不能以数字和下划线开头。'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
        ];
    }
    
    public function getViewById($id)
    {
        $res = User::find()->where(['id'=>$id])->asArray()->one();
        if (!$res) {
            throw new NotFoundHttpException('用户不存在！');
        }
        return $res;
    }
}
