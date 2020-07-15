<?php

namespace app\controllers;

use app\models\News;
use app\models\search\NewsSearch;
use Yii;
use app\models\Rubric;
use yii\web\Controller;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $newsDataProvider = $searchModel->search(Yii::$app->request->get());
        $rubrics = Rubric::getRubricDropdownList();

        if (Yii::$app->request->getIsAjax() && !Yii::$app->request->getIsPjax()) {
            $newses = News::findByRubric(Yii::$app->request->get('rubric'));
            return $this->renderPartial('_news_table', compact('newses'));
        } else {
            $newses = News::find()->asArray()->all();
        }

        return $this->render('index', compact('rubrics', 'newsDataProvider', 'searchModel', 'newses'));
    }
}
