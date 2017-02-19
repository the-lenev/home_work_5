<?php
namespace app\components;

use Yii;
use yii\web\Request;
use app\models\Lang;

class LangRequest extends Request {

    // Объявляем переменную для передачи URL после обработки
    private $_lang_url;
    // Устанавливаем язык и удалем его префикса из URL
    public function getLangUrl() {
        // Если функция еще не отрабатывала, то
        if ($this->_lang_url === null) {
            // Присваиваем переменной полный исходный(полный) URL
	        $this->_lang_url = $this->getUrl();
            // Разбиваем URL на составные части по разделителю '/'
	    	$url_list = explode('/', $this->_lang_url);
            // Если есть 2-й элемент в разбитом массиве (url языка, установленного в UrlManager), то присваеваем его значение переменной
            // Иначе присваиваем переменной 'null'
	    	$lang_url = isset($url_list[1]) ? $url_list[1] : null;
            // Устанавливаем полученное значение языка
            // Если передано 'null' отработает дефолтное значение
	    	Lang::setCurrent($lang_url);
            // После установки значения проверяем
            // Если переданое значение не 'null' и равно текущему языку и в URL стоит после корневого '/'), то
            if( $lang_url !== null && $lang_url === Lang::getCurrent()->url &&
			strpos($this->_lang_url, Lang::getCurrent()->url) === 1 ) {
                // Для дальнейшей обработки передаем значение URL без префикса языка (/ru/site/ преобразуем в /site/)
                $this->_lang_url = substr($this->_lang_url, strlen(Lang::getCurrent()->url)+1);
            }
        }
        // Возвращаем обработанный URL
        return $this->_lang_url;
    }

    // Переопределяем метод resolvePathInfo для получения на вход URL без указания языка
    protected function resolvePathInfo() {

        // Получаем обработанный URL
        $pathInfo = $this->getLangUrl();
        // Если есть GET параметры, то
        if (($pos = strpos($pathInfo, '?')) !== false) {
            // Выделяем часть URL без GET пераметров
            $pathInfo = substr($pathInfo, 0, $pos);
        }
        // Если первый символ '/', то
        if ($pathInfo[0] === '/') {
            // Убираем его
            $pathInfo = substr($pathInfo, 1);
        }
        // Возвращаем обработанный URL
        return (string) $pathInfo;
    }
}
