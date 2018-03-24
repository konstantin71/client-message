<?php

use yii\db\Migration;

/**
 * Class m180201_141100_init_migration
 */
class m180201_141100_init_migration extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $apies = ['telegram', 'viber', 'vk', 'skype', 'facebook',];
        foreach ($apies as $api) {
            $this->insert('api', ['name' => $api]);
        }

        /**
         * Зарегистрированные пользователи
         */
        $users = [
            ['login' => 'user1', 'password' => '1'],
            ['login' => 'user2', 'password' => '2'],
            ['login' => 'user3', 'password' => '3'],
            ['login' => 'user4', 'password' => '4'],
            ['login' => 'admin', 'password' => '5'],
        ];

        foreach ($users as $user) {
            $this->insert('user', $user);
        }
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete('api');
        $this->delete('user');
    }
}
