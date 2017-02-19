<?php
namespace app\models;
use Yii;

class Lang extends \yii\db\ActiveRecord {

    public static function tableName() {
        return 'lang';
    }

    // Правила валидации
    public function rules() {
        return [
            [['url', 'local', 'name'], 'required'],
            [['default'], 'integer'],
            [['url', 'local', 'name'], 'string', 'max' => 255],
        ];
    }

    // Метки полей
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'local' => 'Local',
            'name' => 'Name',
            'default' => 'Default',
        ];
    }

    // Переменная, для хранения текущего языка
    static $current = null;

    // Получение текущего языка
    static function getCurrent() {
        // Если текущий язык не определен, то
        if ( self::$current === null ) {
            // Присаеваем ему значение гетера по умолчанию
            self::$current = self::getDefaultLang();
        }
        return self::$current;
    }

    // Установка текущего языка
    static function setCurrent($url = null) {
        // Находим запись в БД по url
        $language = self::getLangByUrl($url);
        // Если url не передали, то присваиваем текущий язык значению языка по умолчанию, иначе присаиваем найденное в БД значение
        self::$current = ($language === null) ? self::getDefaultLang() : $language;
        // Устанавливаем значение языка приложения из поля локали текущего языка
        Yii::$app->language = self::$current->local;
    }

    // Получения языка по умолчанию
    static function getDefaultLang() {
        // По умолчанию присваиваем значение языка, у которого значение поля "default" равно 1
        return Lang::find()->where('`default` = :default', [':default' => 1])->one();
    }

    // Получения языка по префиксу (url)
    static function getLangByUrl($url = null) {
        // Если передан url 'null' (или не передан), то
        if ($url === null) {
            // Возвращаем null
            return null;
        } else {
            // Иначе ищем в БД запись с url равным переданному
            $language = Lang::find()->where('url = :url', [':url' => $url])->one();
            // Если нет соответствующей записи, то
            if ( $language === null ) {
                // Возвращаем null
                return null;
            } else {
                // Иначе возвращаем запись БД (объект)
                return $language;
            }
        }
    }
}
