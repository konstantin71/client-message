<?php

use yii\db\Migration;

/**
 * Class m180201_125243_init_migration
 */
class m180201_125243_init_migration extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('api', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
        ]);

        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'api_message_id' => $this->integer(),
            'push_message_id' => $this->integer(),
            'login' => $this->string()->notNull()->unique(),
            'password' => $this->string()->notNull(),
        ]);

        /**
         * tabella ip serve per l'identificazione del server di indirizzi ip degli utenti, firmati
         * per le notifiche push (un utente può iscriversi con diversi dispositivi)
         */
        $this->createTable('browse_push', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'name' => $this->string(),
        ]);

        $this->createTable('subscribe', [
            'api_id' => $this->integer(),
            'user_id' => $this->integer(),
        ]);

        $this->addForeignKey('user-browse-fk', 'browse_push', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('api-subscribe-fk', 'subscribe', 'api_id', 'api', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('user-subscribe-fk', 'subscribe', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $tables = ['subscribe', 'browse_push', 'api', 'user'];
        foreach ($tables as $table) {
            $this->dropTable($table);
        }
    }


}
