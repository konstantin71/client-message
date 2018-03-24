<?php

use yii\helpers\Url;

?>

<h1>Подписка на API - месссенджеры</h1>
<?php foreach ($allApi as $api): ?>
    <div class="js_api col-md-2">
        <div id="<?= 'js_user_' . $api->name ?>"><?= $this->render('_api-success') ?></div>
        <a href="<?= Url::toRoute(['apy/messenger', 'userId' => $userId]) ?>"
           class="js_api btn btn-success" data-user_id="<?= $userId ?>" data-api_id="<?= $api->id ?>"
           data-api="<?= $api->name ?>"> <?= $api->name ?>
        </a>
    </div>
<?php endforeach; ?>


