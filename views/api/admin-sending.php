<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelPush app\models\form\FormAdminPush */
/* @var $form ActiveForm */
?>

<div class="api-form-admin">
    <h1>Отправка в мессенджеры</h1>
    <?php $form = ActiveForm::begin(); ?>
    <table>
        <?php foreach ($modelApi->userItemList as $item): ?>
            <?php if ($item['login'] != 'admin'): ?> <!-- костыль -->
                <tr>
                    <td><input type="checkbox" name="<?= $item['id'] ?>" value="<?= $item['login'] ?>"></td>
                    <td><?= $item['login'] ?></td>
                    <td>
                        <?php foreach ($item['apies'] as $apy): ?>
                            <?= $apy['name'] ?>
                        <?php endforeach; ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>
    <?= $form->field($modelApi, 'message')->textarea() ?>
    <?= $form->field($modelApi, 'image')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<div class="push-form-admin">
    <h1>Отправка в PUSH</h1>
    <?php $form = ActiveForm::begin(); ?>
    <table>
        <?php foreach ($modelPush->userItemList as $item): ?>
            <?php if ($item['login'] != 'admin'): ?> <!--костыль-->
                <tr>
                    <td><input type="checkbox" name="<?= $item['id'] ?>" value="<?= $item['login'] ?>"</td>
                    <td><?= $item['login'] ?></td>
                    <td>
                        <?php if ($item['browses']): ?>
                            Подписан
                        <?php else: ?>
                            Неподписан
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>
    <?= $form->field($modelPush, 'message')->textarea() ?>
    <?= $form->field($modelPush, 'image')->checkbox(['value' => 1, 'uncheckValue' => 0]) ?>
    <?= $form->field($modelPush, 'link') ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
