<?php

namespace app\models\form;

use yii\base\Model;

/**
 * Class FormAuthorizationResult
 * @package app\models\form
 */
class FormAuthorizationResult extends Model
{
    public $userId;
    public $browse;
    public $message;
    public $select;

    public function rules()
    {
        return [
            [['userId',], 'integer'],
            [['browse'], 'string'],
            [['message'], 'string'],
            [['select'], 'boolean'],
        ];
    }


}