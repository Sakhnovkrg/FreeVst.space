<?php

namespace app\widgets;

use yii\helpers\Json;
use richardfan\sortable\SortableGridView as BaseWidget;

class SortableGridView extends BaseWidget
{
    public function run()
    {
        foreach ($this->columns as $column) {
            if (isset($column->enableSorting)) {
                $column->enableSorting = false;
            }
        }

        get_parent_class(parent::class)::run();

        $options = [
            'id' => $this->id,
            'action' => $this->sortUrl,
            'sortingPromptText' => $this->sortingPromptText,
            'sortingFailText' => $this->failText,
            'csrfTokenName' => \Yii::$app->request->csrfParam,
            'csrfToken' => \Yii::$app->request->csrfToken,
        ];

        $options = Json::encode($options);

        $this->view->registerJs("jQuery.SortableGridView($options);");
    }
}