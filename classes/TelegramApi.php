<?php

namespace app\classes;

use app\models\db\Api;
use app\models\db\User;

class TelegramApi extends ApiMessenger
{
    const SUCCESS_MESSAGE = ' подписан на Telegram';
    const ERROR_MESSAGE = 'сбой передачи данных';
    public $message;

    public function setGetApi(User $user, Api $api)
    {

        // Доступ к моему боту:
//https://api.telegram.org/bot545471142:AAHYcYaqKHvYH3e2mFomOnxtH51LmGvelJo/метод

//        //-----пока пустой блок функционала подписки в telegram------
//
//
////        $chat_id = 1231231231;  //канал связи бота с пользователем ?
////        $text = 'your text goes here'; //наше сообщение
//
//
////        $disable_web_page_preview = null;
////        $reply_to_message_id = null;
////        $reply_markup = null;
//
////        $data = array(
////            'chat_id' => urlencode($chat_id),
////            'text' => urlencode($text),
////
////            'disable_web_page_preview' => urlencode($disable_web_page_preview),
////            'reply_to_message_id' => urlencode($reply_to_message_id),
////            'reply_markup' => urlencode($reply_markup)
////        );
//
//        $url = https://api.telegram.org/YOUR_TOKEN_GOES_HERE/sendMessage;
//
////  открыть соединение
//$ch = curl_init();
//
////  задать URL-адрес
//curl_setopt($ch, CURLOPT_URL, $url);
//
////  количество почтовых полей
//curl_setopt($ch, CURLOPT_POST, count($fields));
//
////  POST data
//curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
//
////  Показать результат связи
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//
////  выполнить post
//$result = curl_exec($ch);
//
////  закрыть соединение
//curl_close($ch);
//
//
//
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
        $message = $message;
        $result = true; // -это костыль
//        if ($result) debug($message);

        $ch = curl_init();
        $url = "https://api.telegram.org/bot521761122: AAFrfaercnE9DEGnxwZgovT5ABj7nDW0pze/myMethod";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_exec($ch);
        curl_close($ch);

        //-----------------------------------------------
    }

}