<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%catalog}}`.
 */
class m200713_141301_create_rubric_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rubric}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->null(),
            'title' => $this->string()->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%rubric}}');
    }
}
