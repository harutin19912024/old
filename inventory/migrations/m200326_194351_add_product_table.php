<?php

use yii\db\Migration;

/**
 * Class m200326_194351_add_product_table
 */
class m200326_194351_add_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('products', [
            'id' => 'INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'name' => 'VARCHAR(50) NOT NULL',
            'vendor_id' => 'INT(11)',
            'type_id' => 'INT(11)',
            'serial_number' => 'VARCHAR(50) NOT NULL',
            'price' => 'FLOAT(8,2) NOT NULL',
            'weight' => 'FLOAT(8,2)',
            'color' => 'VARCHAR(50)',
            'tags' => 'VARCHAR(255)',
            'img_path' => 'VARCHAR(255)',
            'release_date' => 'DATETIME',
            'created_date' => 'TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP',
        ], 'DEFAULT CHARSET="utf8" collate utf8_general_ci');

        $this->createIndex('vendor_id-index', 'products', 'vendor_id');
        $this->createIndex('type_id-index', 'products', 'type_id');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
	  $this->dropTable('products');
    }
}
