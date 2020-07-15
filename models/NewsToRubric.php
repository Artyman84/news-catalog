<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%news_to_rubric}}".
 *
 * @property int $id
 * @property int $news_id
 * @property int $rubric_id
 *
 * @property News $news
 * @property Rubric $rubric
 */
class NewsToRubric extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%news_to_rubric}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['news_id', 'rubric_id'], 'required'],
            [['news_id', 'rubric_id'], 'integer'],
            [['news_id'], 'exist', 'skipOnError' => true, 'targetClass' => News::class, 'targetAttribute' => ['news_id' => 'id']],
            [['rubric_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rubric::class, 'targetAttribute' => ['rubric_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'news_id' => 'News ID',
            'rubric_id' => 'Rubric ID',
        ];
    }

    /**
     * Gets query for [[News]].
     *
     * @return \yii\db\ActiveQuery|\app\models\queries\NewsQuery
     */
    public function getNews()
    {
        return $this->hasOne(News::class, ['id' => 'news_id']);
    }

    /**
     * Gets query for [[Rubric]].
     *
     * @return \yii\db\ActiveQuery|\app\models\queries\RubricQuery
     */
    public function getRubric()
    {
        return $this->hasOne(Rubric::class, ['id' => 'rubric_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\queries\NewsToRubricQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\NewsToRubricQuery(get_called_class());
    }
}
