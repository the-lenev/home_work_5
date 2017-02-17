<?php
// Определяем пространство имен
namespace app\models;
// Подключаем базовый (родительский) класс
use yii\db\ActiveRecord;

class Task extends ActiveRecord {

    // Имя таблицы
    public static function tableName() {
        return 'task';
    }

    // Правила обработки полей
    public function rules() {
        return [
            [['date', 'text'], 'required', 'message' => 'Поле обязательно для заполнения'],
            [['date'], 'default', 'value' => null],
            [['date'], 'date', 'format' => 'yyyy-MM-dd', 'message' => 'Введена некорректная дата'],
            [['text'], 'string', 'max' => 50, 'message' => 'Превышено максимально допустимое количество символов'],
            [['comment'], 'string', 'max' => 255, 'message' => 'Превышено максимально допустимое количество символов'],
        ];
    }

    // Метки для полей
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'date' => 'Дата',
            'text' => 'Заголовок',
            'comment' => 'Комментарий',
        ];
    }
}
