<?php

/* @var $this yii\web\View */
/* @var $newsDataProvider yii\data\ActiveDataProvider */
/* @var $searchModel app\models\search\NewsSearch */
/* @var $rubrics [] */
/* @var $newses [] */

use app\models\Rubric;
use yii\bootstrap\Html;

$this->title = 'News Catalog';

?>
<div class="site-index">

    <h1>Новостной каталог <small>Загрузка аяксом</small></h1>

    <div class="body-content">
        <div class="row">
            <div class="col-sm-12">
                <?= Html::dropDownList('rubric', null, $rubrics, ['class' => 'form-control'])?>
            </div>
            <br><br>
            <div class="col-sm-12 js-news-table">
                <?= $this->render('_news_table', compact('newses'))?>
            </div>
        </div>
        <br>
        <hr>
        <br>
        <h1>Новостной каталог <small>Грид pjax</small></h1>
        <div class="row">
            <div class="col-sm-12">
                <?= $this->render('_news_grid', compact('newsDataProvider', 'searchModel'));?>
            </div>
        </div>

    </div>
</div>
