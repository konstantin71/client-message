<?php


namespace app\models\form;

use yii\base\Model;

/**
 * Class FormAdminApi
 * @package app\models\form
 */
class FormAdminApi extends Model
{
    public $userItemList = [];
    public $message;
    public $image;

    public function rules()
    {
        return [
            [['message'], 'string'],
            [['image'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'message' => 'Введите сообщение',
            'image' => 'Отправить картинку',
        ];
    }
}
