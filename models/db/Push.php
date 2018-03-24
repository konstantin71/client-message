<?php

namespace app\models\db;

/**
 * This is the model class for table "push".
 * @property int $id
 * @property int $browse_id
 * @property string $message
 * @property string $link
 * @property string $img
 * @property BrowsePush $browse
 */
class Push extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'push';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['browse_id'], 'integer'],
            [['message'], 'required'],
            [['message', 'link', 'img'], 'string'],
            [['browse_id'], 'exist', 'skipOnError' => true, 'targetClass' => BrowsePush::className(), 'targetAttribute' => ['browse_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'browse_id' => 'Browse ID',
            'message' => 'Сообщение',
            'link' => 'Ссылка',
            'img' => 'Img',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrowse()
    {
        return $this->hasOne(BrowsePush::className(), ['id' => 'browse_id']);
    }
}
