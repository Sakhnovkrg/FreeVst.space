<?php

namespace app\controllers;

use app\models\Tag;
use Yii;
use app\models\Category;
use app\models\Stuff;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CategoryController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionView($id, $tagId = null)
    {
        $category = $this->findCategory($id);
        $tag = $this->findTag($tagId);

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
        ])->where(['category_id' => $id])->orderBy(['id' => SORT_DESC]);

        if($tag) {
            $query->joinWith('stuffTags')->andWhere(['stuff_tag.tag_id' => $tagId]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
                'defaultPageSize' => 12,
            ],
        ]);

        $models = $dataProvider->getModels();
        $pagination =$dataProvider->getPagination();

        return $this->render('view', compact(['category', 'dataProvider', 'models', 'pagination', 'tag']));
    }

    protected function findCategory($id)
    {
        if($model = Category::findOne($id)) {
            return $model;
        }
        throw new NotFoundHttpException('Category not found.');
    }

    protected function findTag($id)
    {
        if(!$id) return null;
        if($model = Tag::findOne($id)) {
            return $model;
        }
        throw new NotFoundHttpException('Tag not found.');
    }
}
