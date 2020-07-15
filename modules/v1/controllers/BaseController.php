<?php

namespace app\modules\v1\controllers;

use yii\rest\Controller;
use yii\web\Response;

/**
 * Class BaseController
 * @package app\modules\v1\controllers
 */
abstract class BaseController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats'] = ['application/json' => Response::FORMAT_JSON];
        return $behaviors;
    }
}