<?php

namespace app\controllers;

use app\classes\process\ApiManager;
use app\classes\process\Authorization;
use app\classes\process\PushManager;
use app\models\db\Api;
use app\models\db\User;
use app\models\form\FormAuthorizationResult;
use yii\web\Controller;
use app\models\form\FormAdminApi;
use app\models\form\FormAdminPush;


class ApiController extends Controller
{
    public $enableCsrfValidation = false; //эта строчка для боевого хостинга
    const ADMIN = 'admin';
    public $layout = 'mainApi';

    /**
     * Output of the authorization form. Return the form with a subscription to PUSH.
     * From under admin displays the administrator form
     * @return string
     */
    public function actionAuthorization()
    {
        $browse = $_SERVER['HTTP_USER_AGENT'];
        $user = new User();
        $formAuthorisationResult = new FormAuthorizationResult();

        if ($user->load(\Yii::$app->request->post()) && $user->validate()) {
            $formAuthorisationResult = Authorization::userIdentification($browse, $user);
            if (!$formAuthorisationResult) return $this->redirect(['api/admin-sending']);
        }

        return $this->render('authorization', [
            'user' => $user,
            'formResult' => $formAuthorisationResult,
        ]);
    }

    /**
     * Go to the instant messengers subscription page
     * @return string
     */
    public function actionSubscription()
    {
        $formAuthorisationResult = new FormAuthorizationResult();
        $allApi = Api::find()->all();
        if ($formAuthorisationResult->load(\Yii::$app->request->post()) && $formAuthorisationResult->validate()) {
            if ($formAuthorisationResult->select) Authorization::pushSubscribe($formAuthorisationResult);
        }

        return $this->render('api-subscription', [
            'userId' => $formAuthorisationResult->userId,
            'allApi' => $allApi
        ]);
    }

    /**
     * Asynchronous output content to the user submitting the subscription request to "get messages" through the messengers.
     * Will return a page with a message about the subscription
     * @return string
     */
    public function actionMessenger()
    {
        if (\Yii::$app->request->isAjax) {
            $apiApplication = \Yii::$app->request->post();
            if (isset($apiApplication)) {
                $apiSubscribed = ApiManager::MessengerIdentification($apiApplication);
            }
        }
        return $this->renderPartial('_api-success', [
            'apiSubscribed' => $apiSubscribed
        ]);
    }

    /**
     * The action is started from the authorization functionality for the administrator
     * Returns the message submission page for the selected users to the administrator
     * @return string
     */
    public function actionAdminSending()
    {
        $formAdminApi = new FormAdminApi();
        $formAdminPush = new FormAdminPush();

        $formAdminApi->userItemList = User::find()->with('apies')->asArray()->all();
        $formAdminPush->userItemList = User::find()->with('browses')->asArray()->all();

        if ($formAdminApi->load(\Yii::$app->request->post())) {
            if ($formAdminApi->validate()) {
                ApiManager::messagePrepare($formAdminApi, $_POST);
            }
        }


        if ($formAdminPush->load(\Yii::$app->request->post())) {
            if ($formAdminPush->validate()) {
                PushManager::messagePrepare($formAdminPush, $_POST);
            }
        }

        return $this->render('admin-sending', [
            'modelApi' => $formAdminApi,
            'modelPush' => $formAdminPush
        ]);
    }
}