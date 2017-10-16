<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Role;

/* @var $this yii\web\View */
/* @var $model common\models\Access */
/* @var $form yii\widgets\ActiveForm */

$role_arr = ArrayHelper::map(Role::find()->all(), 'id', 'name');
?>

<div class="access-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'roles')->checkboxList($role_arr, [
            'separator' => '<hr>',
            'item' => function($index, $label, $name, $checked, $value) use($model) {

                $checked = '';

                if(!$model->isNewRecord) {
                    $role = Role::findOne($value);

                    $checked = $role->Access($model->id) ? 'checked' : '';
                }

                return "<input type='checkbox' {$checked} name='{$name}' value='{$value}'>{$label}";
            }
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
