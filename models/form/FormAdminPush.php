<?php
/**
 * Created by PhpStorm.
 * User: kot
 * Date: 05.02.18
 * Time: 12:41
 */

namespace app\models\form;

use yii\base\Model;

/**
 * Class FormAdminPush
 * @package app\models\form
 */
class FormAdminPush extends Model
{
    public $userItemList = [];
    public $message;
    public $image;
    public $link;

    public function rules()
    {
        return [
            [['message'], 'string'],
            [['image'], 'boolean'],
            [['link'], 'url'],

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
            'link' => 'URL'
        ];
    }
}