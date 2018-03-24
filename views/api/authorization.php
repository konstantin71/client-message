<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\db\User */
/* @var $form ActiveForm */

?>

<?php if (!$formResult->userId): ?>
    <div class="api-authorization">
        <?php if ($formResult->message): ?>
            <p><?= $formResult->message ?></p>
        <?php endif; ?>
        <?php $formUser = ActiveForm::begin([
            'method' => 'post',
            'action' => ['api/authorization'],
            'options' => []
        ]); ?>

        <?= $formUser->field($user, 'login') ?>
        <?= $formUser->field($user, 'password')->input('password') ?>

        <div class="form-group">
            <?= Html::submitButton('Продолжить', [
                'class' => 'btn btn-primary',
                'value' => 'Продолжить'
            ]) ?>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
<?php endif; ?>
<?php if ($formResult->userId): ?>
    <?= $this->render('get-subscription', ['model' => $formResult]); ?>
<?php endif; ?>
