<?php

namespace app\models\search;

use yii\data\ActiveDataProvider;
use app\models\News;

class NewsSearch extends \app\models\News
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rubric'], 'integer'],
            [['title', 'text'], 'string'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = News::find()
            ->joinWith(['rubrics'], true, 'INNER JOIN')
            ->groupBy('news.id');

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
                'sort' => [
                    'defaultOrder' => [
                        'title' => SORT_ASC,
                    ]
                ],
                'pagination' => ['defaultPageSize' => 30],
            ]
        );

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['=', 'rubric.id', $this->rubric]);
        $query->andFilterWhere(['=', 'news.id', $this->id]);
        $query->andFilterWhere(['like', 'news.title', $this->title]);
        $query->andFilterWhere(['like', 'news.text', $this->text]);

        return $dataProvider;
    }

}