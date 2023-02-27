<?php

namespace app\controllers;

use Yii;
use app\models\Stuff;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class StuffController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionView($id)
    {
        $model = $this->findStuff($id);
        return $this->render('view', compact('model'));
    }

    protected function findStuff($id)
    {
        if($model = Stuff::find()->active()->where(['id' => $id])->with([
            'stuffTags' => function (\yii\db\ActiveQuery $query) {
                $query->with('tag')->orderBy(['ord' => SORT_ASC]);
            },
            'os' => function (\yii\db\ActiveQuery $query) {
                $query->orderBy(['ord' => SORT_ASC]);
            },
            'formats' => function (\yii\db\ActiveQuery $query) {
                $query->orderBy(['ord' => SORT_ASC]);
            },
            'developer', 'category'])->one()) {
            return $model;
        }
        throw new NotFoundHttpException('Stuff not found.');
    }
}
