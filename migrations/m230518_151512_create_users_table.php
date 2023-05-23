<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m230518_151512_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(255)->notNull(),
            'email'=>$this->string(255)->notNull()->unique(),
            'password'=>$this->string(255)->notNull(),
            'role'=>"ENUM('profy', 'user')",
            'access_token'=>$this->string(255)->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
