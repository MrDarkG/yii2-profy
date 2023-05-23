<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%profy_services}}`.
 */
class m230518_154004_create_profy_services_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%profy_services}}', [
            'id' => $this->primaryKey(),
            'profy_id'=>$this->integer()->notNull(),
            'service_id'=>$this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk_profy_services_profy_id', '{{%profy_services}}', 'profy_id', '{{%users}}', 'id', 'CASCADE');
        $this->addForeignKey('fk_profy_services_service_id', '{{%profy_services}}', 'service_id', '{{%services}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%profy_services}}');
    }
}
