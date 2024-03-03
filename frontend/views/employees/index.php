<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EmployeesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kadrlar bo`limi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-index">




    <?= Html::a('Yangi ishchi qo`shish', ['create'], ['class' => 'btn btn-success']) ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    // echo ExportMenu::widget([
    //     'dataProvider' => $dataProvider,    shu joyni qaytadan ko'rib chiqish kerak
    //     'columns' => $gridColumns
    // ]);
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
//            'mfo',
            [
                'attribute'=>'MFO',
                'filter' => ['0' => 'Toshktrn', '1' => 'Aktiv'],
                'value'=>function($model){
                    $name = \frontend\models\Mfo::findOne($model->mfo)->name;
                    return $name;
                }
            ],
            'lastname',
            'firstname',
            'namefather',
            'date',
            'start_work',
            'comment',
            [
                // 'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'status',
                'label'=>'Holati',
                'filter' => ['0' => 'Bo`shagan', '1' => 'Aktiv'],
                // 'width' => '90px',
                'format'=>'raw',
                // 'vAlign'=>'middle',
                'value'=>function($model){
                    $status = $model->status;
                    $status_btn = "default";

                    if($status===0){
                        $status_btn = "danger";
                        $result_show ="Bo`shagan";
                    }
                    elseif($status===1){
                        $status_btn = "warning";
                        $result_show = "Aktiv";
                    }

                    return '<span class="btn btn-'.$status_btn.' btn-block">'. $result_show.'</span>';
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
