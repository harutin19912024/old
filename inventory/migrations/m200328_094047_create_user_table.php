<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m200328_094047_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'fname' => $this->string(),
            'lname' => $this->string(),
            'email' => $this->string()->notNull()->unique(),
            'password' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull(),
            'role' => "ENUM('admin','regular') NOT NULL DEFAULT 'regular'",
            'auth_key' => $this->string(32)->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'account_activation_token' => $this->string()->unique(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
