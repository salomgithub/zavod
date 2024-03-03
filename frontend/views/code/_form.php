<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use frontend\models\Tovar;

?>
    <?php 
        // $userBranch_id = UserModel::findOne($_SESSION['viloyat']);
        // $region = $userBranch_id['region_id'];
        $tovar = Tovar::find()->all();
        $tovarItems = ArrayHelper::map($tovar,'id','name');
        $mfo = ArrayHelper::map(\frontend\models\Mfo::find()->all(),'id','name');
        $tovarParams = [
            'prompt' => 'Укажите Tovar'
        ];
    ?>

<div class="code-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tovar_id', ['inputOptions'=>['class' => 'form-control', 'tabindex'=>'1']])->dropDownList($tovarItems,$tovarParams)->label('Tovar',['class'=>'tc']) ?>

    <?= $form->field($model, 'code', ['inputOptions'=>['class' => 'form-control', 'tabindex'=>'2']])->textInput() ?>

    <?= $form->field($model, 'price', ['inputOptions'=>['class' => 'form-control', 'tabindex'=>'3']])->textInput() ?>

    <?= $form->field($model, 'mfo', ['inputOptions'=>['class' => 'form-control', 'tabindex'=>'4']])->dropDownList($mfo) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'tabindex'=>'4']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
