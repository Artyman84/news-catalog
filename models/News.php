<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property int $id
 * @property string $title
 * @property string $text
 *
 * @property NewsToRubric[] $newsToRubrics
 * @property Rubric[] $rubrics
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @var int
     */
    public $rubric;

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
     * Gets query for [[NewsToRubrics]].
     *
     * @return yii\db\ActiveQuery|\app\models\queries\NewsToRubricQuery
     */
    public function getNewsToRubrics()
    {
        return $this->hasMany(NewsToRubric::class, ['news_id' => 'id']);
    }

    /**
     * Gets query for [[Rubrics]].
     *
     * @return yii\db\ActiveQuery|\app\models\queries\RubricQuery
     */
    public function getRubrics()
    {
        return $this->hasMany(Rubric::class, ['id' => 'rubric_id'])
            ->viaTable('news_to_rubric', ['news_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\queries\NewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\NewsQuery(get_called_class());
    }

    /**
     * @param int $rubricId
     * @return News[]|array
     */
    public static function findByRubric($rubricId)
    {
        return News::find()
            ->alias('n')
            ->select('n.*')
            ->innerJoin(['nr' => 'news_to_rubric'], 'nr.news_id = n.id')
            ->where(['nr.rubric_id' => $rubricId])
            ->orderBy('title')
            ->asArray()
            ->all();
    }
}
