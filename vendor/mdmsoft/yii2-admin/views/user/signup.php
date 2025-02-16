<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\Signup */

$this->title = Yii::t('rbac-admin', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>
    <?= Html::errorSummary($model) ?>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($model, 'employee_id')->textInput(
                [
                    'prompt' => 'Ishchini tanlang',
                    'onchange' => '
                                    $.ajax({
                                        type: "POST",
                                        url: "index.php?r=my%2Flistuser&id=" + $(this).val(),
                                        success: function (data) {
                                            $("select#user-name").html(data);
                                        },
                                        error: function (xhr, status, error) {
                                            console.error("XHR error:", status, error);
                                            $("select#user-name").html("<option>!!! Bunday ishchi mavjud emas</option>");
                                        }
                                    });
                                '
                ]
            ); ?>
            <select class="form-control" id="user-name">
                <option>MFO</option>
            </select><br>
            <?= $form->field($model, 'username') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'retypePassword')->passwordInput() ?>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('rbac-admin', 'Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
