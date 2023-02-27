<?php

namespace app\rules;

use app\models\Category;
use app\models\Stuff;
use yii\web\UrlRuleInterface;
use yii\base\BaseObject;

class CategoryUrlRule extends BaseObject implements UrlRuleInterface
{
    public function createUrl($manager, $route, $params)
    {
        $cacheKey = [$route, $params];
        if(\Yii::$app->cache->exists($cacheKey)) return \Yii::$app->cache->get($cacheKey);
        if ($route === 'category/view' && $model = Category::findOne($params['id'])) {
            $url = $model->slug;
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

        if (preg_match('%^(.*)$%', $pathInfo, $matches)) {
            $category = $matches[1];
            if($model = Category::findOne(['slug' => $category])) {
                $params = ['id' => $model->id];
                $url = ['category/view', $params];
                \Yii::$app->cache->set($cacheKey, $url);
                return $url;
            }
        }

        return false;
    }
}