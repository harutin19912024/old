<?php

use yii\db\Migration;

/**
 * Class m200401_105425_feed_types_table
 */
class m200401_105425_feed_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('types', ['name' => 'Phone']);
        $this->insert('types', ['name' => 'Tablet']);
        $this->insert('types', ['name' => 'Laptop']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }
}
