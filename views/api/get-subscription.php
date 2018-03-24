<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="api-subscription">
    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'action' => ['api/subscription'],
        'options' => []
    ]); ?>
    <?php if ($model->message): ?>
        <?= Html::label($model->message); ?>
        <?= $form->field($model, 'select')->checkbox(['value' => 1, 'uncheckValue' => 0]) ?>
        <?= $form->field($model, 'browse')->hiddenInput()->label(false); ?>
    <?php endif; ?>
    <?= $form->field($model, 'userId')->hiddenInput()->label(false); ?>
    <div class="form-group">
        <?= Html::submitButton('Подписка API', ['class' => 'btn btn-primary']); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
