<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bookings}}`.
 */
class m230519_134423_create_bookings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%bookings}}', [
            'id' => $this->primaryKey(),
            'profy_id' => $this->integer()->notNull(),
            'service_id' => $this->integer()->notNull(),
            'date' => $this->date()->notNull(),
            'time' => $this->time()->notNull(),
            'till' => $this->time()->notNull(), // 'till' is a reserved word in MySQL, so we use 'till' instead of 'to
            'status' => $this->integer()->defaultValue(1),
            'user_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('fk_bookings_profy_id', '{{%bookings}}', 'profy_id', '{{%users}}', 'id', 'CASCADE');
        $this->addForeignKey('fk_bookings_service_id', '{{%bookings}}', 'service_id', '{{%services}}', 'id', 'CASCADE');
        $this->addForeignKey('fk_bookings_user_id', '{{%bookings}}', 'user_id', '{{%users}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%bookings}}');
    }
}
