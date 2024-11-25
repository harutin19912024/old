<?php

use yii\db\Migration;

/**
 * Class m200326_201255_add_types_table
 */
class m200326_201255_add_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
	  $this->createTable('types', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique(),
            'created_date' => 'TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
	  $this->dropTable('types');
    }
}
