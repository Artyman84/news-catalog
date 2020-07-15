<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news_to_catalog}}`.
 */
class m200713_141644_create_news_to_rubric_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%news_to_rubric}}', [
            'id' => $this->primaryKey(),
            'news_id' => $this->integer()->notNull(),
            'rubric_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-news_to_rubric-news_id',
            'news_to_rubric',
            'news_id'
        );

        $this->addForeignKey(
            'fk-news_to_rubric-news_id-news-id',
            '{{%news_to_rubric}}',
            'news_id',
            'news',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'idx-news_to_rubric-rubric_id',
            'news_to_rubric',
            'rubric_id'
        );

        $this->addForeignKey(
            'fk-news_to_rubric-rubric_id-rubric-id',
            '{{%news_to_rubric}}',
            'rubric_id',
            'rubric',
            'id',
            'CASCADE',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-news_to_rubric-news_id-news-id',
            'news_to_rubric'
        );

        $this->dropIndex(
            'idx-news_to_rubric-news_id',
            'news_to_rubric'
        );

        $this->dropForeignKey(
            'fk-news_to_rubric-rubric_id-rubric-id',
            'news_to_rubric'
        );

        $this->dropIndex(
            'idx-news_to_rubric-rubric_id',
            'news_to_rubric'
        );

        $this->dropTable('{{%news_to_rubric}}');
    }
}
