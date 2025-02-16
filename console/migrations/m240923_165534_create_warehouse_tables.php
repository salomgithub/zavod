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
        // Ombor kirim jadvali
        $this->createTable('warehouse_input', [
            'id' => $this->primaryKey(),                              // Unikal ID
            'name' => $this->string(255)->notNull(),                  // Mahsulot nomi
            'color' => $this->string(50),                             // Mahsulot rangi
            'type' => $this->string(100),                             // Mahsulot turi
            'size' => $this->decimal(10, 2)->notNull(),               // Miqdor
            'size_type' => "ENUM('kg', 'metr', 'liter', 'dona') NOT NULL", // Miqdor birligi
            'supplier' => $this->string(255),                         // Yetkazib beruvchi
            'date_received' => $this->date()->notNull(),              // Kirim sanasi
            'batch_number' => $this->string(50),                      // Partiya raqami
            'storage_location' => $this->string(255),                 // Saqlash joyi
            'comments' => $this->text(),
            'mfo' => $this->string(10)->notNull(), // MFO
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),// Qo'shimcha izohlar
        ]);

        // Ombor chiqim jadvali
        $this->createTable('warehouse_output', [
            'id' => $this->primaryKey(),                              // Unikal ID
            'product_id' => $this->integer()->notNull(),              // Mahsulot ID (foreign key)
            'quantity' => $this->decimal(10, 2)->notNull(),           // Chiqayotgan mahsulot miqdori
            'receiver' => $this->string(255)->notNull(),              // Oluvchi
            'purpose' => $this->string(255),                          // Maqsad
            'date_of_exit' => $this->date()->notNull(),               // Chiqim sanasi
            'destination' => $this->string(255),                      // Yetkazish manzili
            'transport_info' => $this->string(255),                   // Transport ma'lumotlari
            'authorized_by' => $this->string(255),                    // Ruxsat bergan shaxs
            'comments' => $this->text(),
            'mfo' => $this->string(10)->notNull(), // MFO
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),// Qo'shimcha izohlar
        ]);

        // Foreign key - product_id ombor kirim jadvalidan
        $this->addForeignKey(
            'fk-product-id',
            'warehouse_output',
            'product_id',
            'warehouse_input',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Foreign keyni olib tashlash
        $this->dropForeignKey('fk-product-id', 'warehouse_output');

        // Jadvallarni o'chirish
        $this->dropTable('warehouse_output');
        $this->dropTable('warehouse_input');
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
