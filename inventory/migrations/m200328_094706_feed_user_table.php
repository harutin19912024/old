<?php

use yii\db\Migration;

/**
 * Class m200328_094706_feed_user_table
 */
class m200328_094706_feed_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('user', [
                'email' => 'admin@admin.com',
                'auth_key' => 'HKNqXWjpOjIvMzmDbKQ0uKIewbBx6qQ_',
                'role' => 'admin',
                'password' => '$2y$13$pbnKeBOxvTwxrKu/tsysuOWHk4jWotc2Hqg0LPBjCziwZws/4fyUi'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }

}
