<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Role;
use common\models\LoginForm;

/**
 * Site controller
 */
class CController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function beforeAction($action)
    {

        if($this->action->id != 'login' && $this->id != 'site' && yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        if(!yii::$app->user->isGuest && $this->action->id != 'logout' && $this->id != 'site') {

            $path = yii::$app->request->baseUrl.'/'.yii::$app->request->pathInfo;

            if(!yii::$app->user->identity->roleo->can($path)) {
                $this->throwAccessError();
            }
        }

        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function throwAccessError() {
        throw new \yii\web\HttpException(403, 'Вы не имеете доступ к данному разделу!');
    }
}
