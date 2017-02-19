<?php
namespace app\components;

use yii\web\UrlManager;
use app\models\Lang;

class LangUrlManager extends UrlManager {

    public function createUrl($params) {

        // Получаем текущий язык и модели
        $lang = Lang::getCurrent();
        // Получаем исходный URL от родительского класса
        $url = parent::createUrl($params);
        // Если находимся в корне, то выводим url языка (ru||en)
        if ( $url == '/' ) {
            return '/'.$lang->url;
        // Иначе к url языка добавляем исходный URL
        } else {
            return '/'.$lang->url.$url;
        }
    }
}
