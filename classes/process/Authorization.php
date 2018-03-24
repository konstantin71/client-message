<?php

namespace app\classes\process;

use app\models\db\BrowsePush;
use app\models\db\User;
use app\models\form\FormAuthorizationResult;

/**
 * Class Authorization
 * @package app\classes\process
 */
class Authorization
{
    const PUSH_MESSAGE = 'Подписаться на PUSH сообщение';
    const IGNORE_MESSAGE = 'Мы Вас не знаем';

    /**
     * User identification
     * @param $browse
     * @param User $user
     * @return FormAuthorizationResult
     */
    public static function userIdentification($browse, User $user)
    {
        $form = new FormAuthorizationResult();
        $identifiedUser = User::find()->where([
            'login' => $user->login,
            'password' => $user->password,
        ])->one();

        if ($identifiedUser) {
            if ($identifiedUser->login == 'admin') return false;
            self::browserIdentification($browse, $identifiedUser, $form);
        } else {
            $form->userId = false;
            $form->message = self::IGNORE_MESSAGE;
        }
        return $form;
    }

    /**
     * The identity of the browser user is subscribed to a PUSH message
     * @param $browse
     * @param $user
     * @param $form
     * @return mixed
     */
    private static function browserIdentification($browse, $user, $form)
    {
        $form->userId = $user->id;
        $form->message = self::PUSH_MESSAGE;
        $form->browse = $browse;
        $browsesPush = $user->browses;

        foreach ($browsesPush as $browsePush) {
            if ($browse == $browsePush->name) {
                $form->message = null;
                break;
            }
        }
        return $form;
    }

    /**
     * The entry in the db browser authorized user for PUSH notification
     * @param FormAuthorizationResult $form
     */
    public static function pushSubscribe(FormAuthorizationResult $form)
    {
        $browsePush = new BrowsePush();
        $browsePush->user_id = $form->userId;
        $browsePush->name = $form->browse;
        $browsePush->save();
    }
}