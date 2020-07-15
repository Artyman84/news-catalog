<?php

use yii\db\Migration;

/**
 * Class m200713_171622_fill_in_rubrics
 */
class m200713_171622_fill_in_rubrics extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $rubrics = require __DIR__ . '/../data/rubrics.php';
        $this->processRubrics($rubrics);
    }

    /**
     * Fill in rubrics.
     * @param array $rubrics
     * @param null $parentId
     */
    private function processRubrics($rubrics, $parentId = null)
    {
        $db = Yii::$app->db;
        foreach ($rubrics as $rubric) {
            $db->createCommand()->insert('{{%rubric}}', ['title' => $rubric['title'], 'parent_id' => $parentId])->execute();

            if (isset($rubric['children'])) {
                $this->processRubrics($rubric['children'], $db->getLastInsertID());
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('{{%rubric}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200713_171622_fill_in_rubrics cannot be reverted.\n";

        return false;
    }
    */
}
