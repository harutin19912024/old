<?php

use yii\db\Migration;

/**
 * Class m200326_201018_add_vendors_table
 */
class m200326_201018_add_vendors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
	  $this->createTable('vendors', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'logo' => $this->string()->notNull(),
            'created_date' => 'TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('vendors');
    }
}
