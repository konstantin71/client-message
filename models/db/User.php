<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 * @property int $id
 * @property string $name
 * @property string $login
 * @property string $password
 * @property BrowsePush[] $browsePushes
 * @property Subscribe[] $subscribes
 */
class User extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            [['login', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Логин',
            'password' => 'Пароль',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrowses()
    {
        return $this->hasMany(BrowsePush::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApies()
    {
        return $this->hasMany(Api::className(), ['id' => 'api_id'])->viaTable('subscribe', ['user_id' => 'id']);
    }


}
