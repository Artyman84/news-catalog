<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%rubric}}".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $title
 *
 * @property NewsToRubric[] $newsToRubrics
 * @property News[] $news
 */
class Rubric extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%rubric}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['title'], 'required'],
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
            'parent_id' => 'Parent ID',
            'title' => 'Заголовок',
        ];
    }

    /**
     * Gets query for [[NewsToRubrics]].
     *
     * @return yii\db\ActiveQuery|\app\models\queries\NewsToRubricQuery
     */
    public function getNewsToRubrics()
    {
        return $this->hasMany(NewsToRubric::class, ['rubric_id' => 'id']);
    }

    /**
     * Gets query for [[News]].
     *
     * @return yii\db\ActiveQuery|\app\models\queries\NewsQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::class, ['id' => 'news_id'])
            ->viaTable('news_to_rubric', ['rubric_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\queries\RubricQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\RubricQuery(get_called_class());
    }

    /**
     * @param string $prefix
     * @return array
     */
    public static function getRubricDropdownList($prefix = '--'): array
    {
        $list = [];
        Rubric::collectRubricList($list, $prefix);
        return $list;
    }

    /**
     * @param array $list
     * @param string $prefix
     * @param null $parentId
     * @param int $level
     */
    private static function collectRubricList(&$list, $prefix = '--', $parentId = null, $level = 0): void
    {
        $rubrics = Rubric::find()->where(['parent_id' => $parentId])->orderBy('title')->asArray()->all();
        $_prefix = '';

        if ($prefix) {
            for ($i = 0; $i < $level; ++$i) {
                $_prefix .= '¦' . $prefix;
            }
        }

        foreach ($rubrics as $rubric) {
            $list[$rubric['id']] = $_prefix . $rubric['title'];
            Rubric::collectRubricList($list, $prefix, $rubric['id'], $level + 1);
        }
    }
}
