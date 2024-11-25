<?php

use yii\db\Migration;

/**
 * Class m200327_180830_add_foreign_keys
 */
class m200327_180830_add_foreign_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addForeignKey('fk-vendors_id_fkey', 'products', 'vendor_id', 'vendors', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk-types_id_fkey', 'products', 'type_id', 'types', 'id', 'SET NULL', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('fk-vendors_id_fkey', 'vendors');
        $this->dropForeignKey('fk-types_id_fkey', 'types');
    }
}
