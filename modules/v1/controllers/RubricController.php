<?php

namespace app\modules\v1\controllers;

use app\modules\v1\models\Rubric;

/**
 * Class RubricController
 * @package app\modules\v1\controllers
 */
class RubricController extends BaseController
{
    /**
     * Index action.
     * @param null|int $level
     * @return Rubric[]|array
     */
    public function actionIndex($level = null)
    {
        return Rubric::getRubrics($level);
    }
}