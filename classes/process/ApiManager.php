<?php


namespace app\classes\process;

use app\classes\FacebookApi;
use app\classes\SkypeApi;
use app\classes\TelegramApi;
use app\classes\ViberApi;
use app\classes\VkApi;
use app\models\db\User;
use app\models\form\FormAdminApi;

/**
 * Class ApiManager
 * @package app\classes\process
 */
class ApiManager
{
    const SECURITY_MESSAGE = 'Вы уже подписались';

    /**
     * Identification of the messenger, to create an instance of the desired class
     * @param $apiApplication
     * @return array|mixed
     */
    public static function MessengerIdentification($apiApplication)
    {
        if (self::security($apiApplication['userId'], $apiApplication['apiId'])) {
            $message = self::SECURITY_MESSAGE;
            $resultSubscribe = ['message' => $message, 'usersApi' => null];
            return $resultSubscribe;
        }

        $api = $apiApplication['api'];
        $messenger = self::messengerSelect($api);
        $user = $messenger->queryUserDb($apiApplication['userId']);
        $api = $messenger->queryApiDb($apiApplication['apiId']);
        if ($user && $api) {
            return $messenger->setGetApi($user, $api);
        }
    }

    /**
     * Verifica la disponibilità di un abbonamento utente API
     * @param $userId
     * @param $apiId
     * @return bool
     */
    private function security($userId, $apiId)
    {
        $user = User::findOne($userId);
        $api = $user->getApies()->where(['id' => $apiId])->one();
        if ($api) return true;
    }

    /**
     * La formazione di un pacchetto di oggetti API messaggi
     * @param FormAdminApi $formAdminApi
     * @param $post
     */
    public static function messagePrepare(FormAdminApi $formAdminApi, $post)
    {
        $users = $formAdminApi['userItemList'];
        foreach ($post as $item => $value) {
            foreach ($users as $user) {
                if ($item == $user['id']) {
                    foreach ($user['apies'] as $api) {
                        $messenger = self::messengerSelect($api['name']);
                        $messenger->message['message'] = $formAdminApi['message'];
                        $messenger->message['image'] = $formAdminApi['image'];
                        $messenger->message['userId'] = $user['id'];
                        $messenger->message['userLogin'] = $user['login'];
                        $messenger->message['userPassword'] = $user['password'];
                        $messenger->message['apiId'] = $api['id'];
                        $messenger->message['apiName'] = $api['name'];
                        $messenger->setGetApiMessage($messenger->message);
                    }
                }
            }
        }
    }

    /**
     * Definizione di un set in entrata messenger alla classe API
     * @param $api
     * @return FacebookApi|SkypeApi|TelegramApi|ViberApi|VkApi
     */
    private function messengerSelect($api)
    {
        switch ($api) {
            case 'telegram' :
                $messenger = new TelegramApi();
                break;
            case 'viber' :
                $messenger = new ViberApi();
                break;
            case 'vk' :
                $messenger = new VkApi();
                break;
            case 'skype' :
                $messenger = new SkypeApi();
                break;
            case 'facebook' :
                $messenger = new FacebookApi();
                break;
        }
        return $messenger;
    }


}