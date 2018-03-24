<?php
//
//namespace app\controllers;
//
//use Yii;
//use yii\web\Controller;
//
//class TelegramController extends Controller
//{
//    /**
//     * Устанавливает Webhook, по которому будет стучаться бот
//     */
//    public function actionSet()
//    {
//        if (Yii::$app->telegram->setWebhook()) {
//            $bot = Yii::$app->telegram->client_messageBot;
//            echo "Webhook привязан к боту '{$bot}'\n";
//        }
//    }
//
//    /**
//     * Удаляет Webhook, установленный ранее
//     */
//    public function actionUnset()
//    {
//        if (Yii::$app->telegram->unsetWebhook()) {
//            $bot = Yii::$app->telegram->client_messageBot;
//            echo "Webhook отвязан от бота '{$bot}'\n";
//        }
//    }
//}
?>