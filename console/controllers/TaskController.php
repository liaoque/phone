<?php

namespace console\controllers;

use console\models\Logs;
use console\models\Tasks;

class TaskController extends \yii\console\Controller
{
    public function actionIndex()
    {
        Tasks::run();
        Logs::run();

    }

}
