<?php

namespace app\rules;

use app\models\Category;
use app\models\Tag;
use yii\web\UrlRuleInterface;
use yii\base\BaseObject;

class TagUrlRule extends BaseObject implements UrlRuleInterface
{
    public function createUrl($manager, $route, $params)
    {
        $cacheKey = [$route, $params];
        if(\Yii::$app->cache->exists($cacheKey)) return \Yii::$app->cache->get($cacheKey);
        if ($route === 'category/view' && isset($params['tagId'])) {
            $tag = Tag::findOne($params['tagId']);
            if(!$tag) return false;
            $model = Category::findOne($params['id']);
            if(!$model) return false;
            $url = $model->slug . '/' . $tag->name . '-tag';
            \Yii::$app->cache->set($cacheKey, $url);
            return $url;
        }
        return false;
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        $cacheKey = 'url:' . $pathInfo;
        if(\Yii::$app->cache->exists($cacheKey)) return \Yii::$app->cache->get($cacheKey);

        if (preg_match('%^(.*)/(.*)-tag$%', $pathInfo, $matches)) {
            $category = $matches[1];
            $tag = $matches[2];

            if(!$category = Category::findOne(['slug' => $category])) return false;
            if($model = Tag::findOne(['name' => $tag])) {
                $params = ['id' => $category->id, 'tagId' => $model->id];
                $url = ['category/view', $params];
                \Yii::$app->cache->set($cacheKey, $url);
                return $url;
            }
        }

        return false;
    }
}