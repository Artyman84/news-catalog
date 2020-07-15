<?php

use yii\db\Migration;

/**
 * Class m200713_184413_fill_in_news
 */
class m200713_184413_fill_in_news extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $newses = require __DIR__ . '/../data/news.php';
        $db = Yii::$app->db;

        foreach ($newses as $news) {
            $db->createCommand()->insert('{{%news}}', ['title' => $news['title'], 'text' => $news['text']])->execute();
            $newsId = $db->getLastInsertID();
            
            foreach ($news['rubrics'] as $rubric) {
                $rubricId = $db
                    ->createCommand('SELECT `id` FROM {{%rubric}} WHERE `title` = :rubric')
                    ->bindParam(':rubric', $rubric)
                    ->queryScalar();

                $db->createCommand()->insert('{{%news_to_rubric}}', ['news_id' => $newsId, 'rubric_id' => $rubricId])->execute();
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('{{%news}}');
        $this->truncateTable('{{%news_to_rubric}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200713_184413_fill_in_news cannot be reverted.\n";

        return false;
    }
    */
}
