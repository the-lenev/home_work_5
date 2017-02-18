<?php
// Определяем пространство имен
namespace app\models;
// Подключаем базовый (родительский) класс
use yii\db\ActiveRecord;
use Yii;

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

    // Отправка сообщения на почту
    public function sendEmail() {

        if ($this->validate()) {
            // Cоздаем экземпляр почтового сообщения
            Yii::$app->mailer->compose()
                // Заполняем его
                ->setFrom('from@domain.com')
                // Почту для отправки берем из параметров конфига
                ->setTo(Yii::$app->params['adminEmail'])
                // Объект берем из названия задачи
                ->setSubject($this->text)
                //->setTextBody('Change task list')
                ->setHtmlBody('<strong>Change task list</strong>')
                // Отправляем
                ->send();
            return true;
        }
        return false;
    }
}
