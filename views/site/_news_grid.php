<?php

/* @var $this yii\web\View */
/* @var $newsDataProvider yii\data\ActiveDataProvider */
/* @var $searchModel app\models\search\NewsSearch */

use app\models\Rubric;
use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

Pjax::begin();
echo GridView::widget(
    [
        'dataProvider' => $newsDataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',

            [
                'attribute' => 'rubric',
                'headerOptions' => ['style' => 'width: 15%;'],
                'filterInputOptions' => ['class' => 'form-control'],
                'format' => 'html',
                'value' => function(\app\models\News $model) use($searchModel) {
                    $li = [];
                    foreach ($model->rubrics as $rubric) {
                        $li[] = '<li class="nowrap">' . Html::encode($rubric->title) . '</li>';
                    }
                    return '<ul>' . implode('', $li) . '</ul>';
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'rubric',
                    Rubric::getRubricDropdownList(),
                    ['prompt' => 'Все', 'class' => 'form-control nowrap']
                ),
            ],

            [
                'attribute' => 'title',
                'headerOptions' => ['style' => 'width: 20%;'],
            ],

            'text',
        ]
    ]
);
Pjax::end();
?>
