<?php

namespace app\modules\v1\models;

use app\models\Rubric;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property int $id
 * @property string $title
 * @property string $text
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%news}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text'], 'required'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rubric' => 'Рубрика',
            'title' => 'Заголовок',
            'text' => 'Текст',
        ];
    }

    /**
     * @param int $rubricId
     * @return News[]|array
     */
    public static function findByRubricAndChild($rubricId)
    {
        $rubrics = array_merge(
            [$rubricId],
            Rubric::find()->select('id')->where(['parent_id' => $rubricId])->column()
        );

        return News::find()
            ->alias('n')
            ->select('n.*')
            ->innerJoin(['nr' => 'news_to_rubric'], 'nr.news_id = n.id')
            ->where(['nr.rubric_id' => $rubrics])
            ->groupBy('n.id')
            ->orderBy('title')
            ->asArray()
            ->all();
    }
}
