<?php

namespace app\modules\admin\controllers;

use app\models\Stuff;
use app\models\StuffFormat;
use app\models\StuffOs;
use app\models\StuffSearch;
use app\models\StuffTag;
use app\models\Tag;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StuffController implements the CRUD actions for Stuff model.
 */
class StuffController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Stuff models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new StuffSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->sort = ['defaultOrder' => ['id' => SORT_DESC]];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    protected function afterSave($stuff)
    {
        $post = \Yii::$app->request->post();
        $os = ArrayHelper::getValue($post, 'os');
        if($os) {
            StuffOs::deleteAll(['stuff_id' => $stuff->id]);
            foreach ($os as $key => $item) {
                $model = new StuffOs();
                $model->stuff_id = $stuff->id;
                $model->os_id = $item;
                $model->save();
            }
        }
        $format = ArrayHelper::getValue($post, 'format');
        if($format) {
            StuffFormat::deleteAll(['stuff_id' => $stuff->id]);
            foreach ($format as $key => $item) {
                $model = new StuffFormat();
                $model->stuff_id = $stuff->id;
                $model->format_id = $item;
                $model->save();
            }
        }
        $tags = ArrayHelper::getValue($post, 'tags');
        $stuffTags = StuffTag::find()->where(['stuff_id' => $stuff->id])->with('tag')->all();
        foreach ($stuffTags as $item) {
            $item->tag->freq = $item->tag->freq - 1;
            $item->tag->save();
            $item->delete();
        }

        if($tags) {
            foreach (explode(', ', $tags) as $i => $item) {
                $tag = Tag::findOne(['name' => $item]);
                if(!$tag) {
                    $tag = new Tag();
                    $tag->name = $item;
                    $tag->save();
                }
                $model = new StuffTag();
                $model->stuff_id = $stuff->id;
                $model->tag_id = $tag->id;
                $model->ord = $i;
                $model->save();

                $count = StuffTag::find()->where(['tag_id' => $tag->id])->count();
                $tag->freq = $count;
                $tag->save();
            }
        }

        $this->deleteEmptyTags();
    }

    protected function deleteEmptyTags()
    {
        Tag::deleteAll(['freq' => 0]);
    }

    /**
     * Creates a new Stuff model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Stuff();
        $model->scenario = 'insert';

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $this->afterSave($model);
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Stuff model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $this->afterSave($model);
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Stuff model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $stuffTags = StuffTag::find()->where(['stuff_id' => $id])->with('tag')->all();

        foreach ($stuffTags as $item) {
            $item->tag->freq = $item->tag->freq - 1;
            $item->tag->save();
        }

        $model->delete();
        $this->deleteEmptyTags();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Stuff model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Stuff the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Stuff::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
