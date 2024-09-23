<?php

use yii\db\Migration;

/**
 * Class m240923_165534_create_warehouse_tables
 */
class m240923_165534_create_warehouse_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240923_165534_create_warehouse_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240923_165534_create_warehouse_tables cannot be reverted.\n";

        return false;
    }
    */
}
