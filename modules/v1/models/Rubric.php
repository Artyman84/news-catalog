<?php

namespace app\modules\v1\models;

/**
 * This is the model class for table "{{%rubric}}".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $title
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
     * @param null|int $maxLevel
     * @return Rubric[]|array
     */
    public static function getRubrics($maxLevel = null)
    {
        return self::getRubricHierarchy($maxLevel);
    }

    /**
     * @param null|int $maxLevel
     * @param null|int $parentId
     * @param int $level
     * @return Rubric[]|array
     */
    private static function getRubricHierarchy($maxLevel = null, $parentId = null, $level = 0): array
    {
        $rubrics = Rubric::find()->where(['parent_id' => $parentId])->orderBy('title')->asArray()->all();

        foreach ($rubrics as &$rubric) {

            if (!isset($maxLevel) || $maxLevel > $level) {
                $rubric['children'] = Rubric::getRubricHierarchy($maxLevel, $rubric['id'], $level + 1);
            }
        }

        return $rubrics;
    }
}
