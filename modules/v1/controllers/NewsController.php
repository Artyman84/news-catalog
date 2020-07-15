<?php

namespace app\modules\v1\controllers;

use app\modules\v1\models\News;

/**
 * Default controller for the `v1` module
 */
class NewsController extends BaseController
{
    /**
     * Index action.
     * @param $rubric
     * @return News[]|array
     */
    public function actionIndex($rubric)
    {
        return News::findByRubricAndChild($rubric);
    }
}
