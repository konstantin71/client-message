<?php

namespace app\classes\process;


use app\classes\BrowsePush;
use app\models\form\FormAdminPush;

/**
 * Class PushManager
 * @package app\classes\process
 */
class PushManager
{
    /**
     * La formazione di un pacchetto di oggetti PUSH dei messaggi
     * @param FormAdminPush $formAdminPush
     * @param $post
     */
    public static function messagePrepare(FormAdminPush $formAdminPush, $post)
    {
        $users = $formAdminPush['userItemList'];

        foreach ($post as $item => $value) {
            foreach ($users as $user) {
                if ($item == $user['id']) {
                    foreach ($user['browses'] as $browse) {
                        $push['message'] = $formAdminPush['message'];
                        $push['image'] = $formAdminPush['image'];
                        $push['url'] = $formAdminPush['link'];
                        $push['userId'] = $user['id'];
                        $push['userLogin'] = $user['login'];
                        $push['userPassword'] = $user['password'];
                        $push['apiId'] = $browse['id'];
                        $push['apiId'] = $browse['name'];
                        $browse = new BrowsePush();
                        $browse->setGetBrowsePushMessage($push);
                    }
                }
            }
        }
    }

}