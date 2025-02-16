<?php

namespace frontend\controllers;

use frontend\models\Orders;
use frontend\models\Qoldiq;
use frontend\models\Tovar;
use frontend\models\WarehouseInput;
use frontend\models\Warehouseout;
use frontend\models\WarehouseOutput;
use frontend\models\WarehouseoutSearch;
use Yii;
use frontend\models\Warehouse;
use frontend\models\WarehouseSearch;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WarehouseController implements the CRUD actions for Warehouse model.
 */
class WarehouseController extends Controller
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

    public $layout = 'warehouse';

    public function actionIndex()
    {
        // Yii2 Active Record query
        $data_monitoring = (new \yii\db\Query())
            ->select([
                'rm.name AS material_name',                   // Xomashyo nomi
                'rm.color AS material_color',                 // Xomashyo rangi
                'SUM(DISTINCT wi.quantity) AS total_input',   // Omborga kirgan jami mahsulot miqdori, DISTINCT bilan kirimlar hisoblanadi
                'IFNULL(SUM(wo.quantity), 0) AS total_output',// Ombordan chiqqan jami mahsulot miqdori
                '(SUM(DISTINCT wi.quantity) - IFNULL(SUM(wo.quantity), 0)) AS available_stock'  // Omborda mavjud bo'lgan mahsulot miqdori
            ])
            ->from('warehouse_input wi')                       // Omborga kirim jadvali
            ->leftJoin('warehouse_output wo', 'wi.material_id = wo.material_id')  // Ombordan chiqim jadvali bilan bog'lash
            ->innerJoin('materials rm', 'wi.material_id = rm.id')  // Xomashyo jadvali bilan mahsulot bog'lash
            ->groupBy(['rm.name', 'rm.color'])                 // Guruhlash
            ->all();                                           // Natijalarni array shaklida qaytarish

        $data_in = WarehouseInput::find()->all();
        $data_out = WarehouseOutput::find()->all();
        return $this->render('index', [
            'data_monitoring' => $data_monitoring,
            'data_in' => $data_in,
            'data_out' => $data_out,
        ]);
    }


    function findModel($id)
    {
        if (($model = Warehouse::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}
