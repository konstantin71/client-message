<?php

namespace app\classes;

use app\models\db\Api;
use app\models\db\User;

class ViberApi extends ApiMessenger
{
    const SUCCESS_MESSAGE = ' подписан на Viber';
    const ERROR_MESSAGE = 'сбой передачи данных';
    public $message;

    public function setGetApi(User $user, Api $api)
    {

        //-----пока пустой блок функционала подписки в viber------

        $result = true; // -это костыль

        //-----------------------------------------------

        if ($result) {
            $this->apiApplicationSaveDb($user, $api);
            $message = $user->login . self::SUCCESS_MESSAGE;
        } else $message = self::ERROR_MESSAGE;

        $usersApi = $this->queryUsersApi($api);
        $resultSubscribe = ['message' => $message, 'usersApi' => $usersApi];

        return $resultSubscribe;
    }

    public function setGetApiMessage($message)
    {
        //-----пока пустой блок функционала отправки в telegram------

        $result = true; // -это костыль
        if ($result) debug($message);

        //-----------------------------------------------
    }
}