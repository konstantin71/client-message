<?php

namespace app\classes;

use app\models\db\ApiMessage;
use app\models\db\Subscribe;
use app\models\db\User;
use app\models\db\Api;

/**
 * Class ApiMessenger
 * @package app\classes
 */
abstract class ApiMessenger
{

    /**
     * Abstract method subscribe to the API according to the application user
     * @param User $user
     * @param Api $api
     * @return mixed
     */
    public abstract function setGetApi(User $user, Api $api);

    /**
     * Available in the class method fetch a user id from the database
     * @param $userId
     * @return null|static
     */
    public function queryUserDb($userId)
    {
        $user = User::findOne($userId);
        return $user;
    }

    public function queryApiDb($apiId)
    {
        $api = Api::findOne($apiId);
        return $api;
    }

    /**
     * Available in the class write method subscribed to API users
     * @param User $user
     * @param Api $api
     */
    protected function apiApplicationSaveDb(User $user, Api $api)
    {
        $apiSubscribe = new Subscribe();
        $apiSubscribe->user_id = $user->id;
        $apiSubscribe->api_id = $api->id;
        $apiSubscribe->save();
    }

    /**
     * Available in the class method fetch all users subscribed to an API from a database
     * @param Api $api
     * @return array|\yii\db\ActiveRecord[]
     */
    protected function queryUsersApi(Api $api)
    {
        $users = $api->getUsers()->all();
        return $users;
    }


}