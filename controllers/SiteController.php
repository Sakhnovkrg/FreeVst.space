<?php

namespace app\controllers;

use app\models\Stuff;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = Stuff::find()->active()->with([
            'stuffTags' => function (\yii\db\ActiveQuery $query) {
                $query->with('tag')->orderBy(['ord' => SORT_ASC]);
            },
            'os' => function (\yii\db\ActiveQuery $query) {
                $query->orderBy(['ord' => SORT_ASC]);
            },
            'formats' => function (\yii\db\ActiveQuery $query) {
                $query->orderBy(['ord' => SORT_ASC]);
            },
            'developer'
        ])->orderBy(['id' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
                'defaultPageSize' => 12,
            ],
        ]);

        $models = $dataProvider->getModels();
        $pagination = $dataProvider->getPagination();
        return $this->render('index', compact('models', 'pagination'));
    }
}
