<?php

namespace frontend\controllers;

use frontend\models\Employees;
use frontend\models\Mfo;
use frontend\models\User;
use Yii;
use frontend\models\Worker;
use frontend\models\WorkSearch;
use frontend\models\Code;
use frontend\models\Orders;
use frontend\models\Tovar;
use frontend\models\Oylik;
use frontend\models\WorkerSearch;
use frontend\models\WorkerrSearch;
use yii\base\BaseObject;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

/**
 * WorkerController implements the CRUD actions for Worker model.
 */
class MyController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionListuser($id)
    {
        $user = Employees::findOne($id);
        $mfo_id = $user->mfo;
        
        $mfo_name = Mfo::findOne($mfo_id)->name;

        echo "<option value='0'>".$mfo_name."</option>";
        
    }
}
