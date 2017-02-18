<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
// Подключаем модель
use app\models\Task;

class SiteController extends Controller {

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    // Отображение списка задач
    public function actionIndex() {
        // Получаем все записи из таблицы в виде массиса и сортируем их по дате
        $model = Task::find()->orderBy('date')->asArray()->all();
        // Отображаем шаблон (1-й параметр) и передаем в него данные из модели (2-й параметр)
        return $this->render('index', [
            'model' => $model
        ]);
    }

    // Добавление задачи в список
    public function actionCreate() {
        // Создаем новую запись в таблице
        $model = new Task();
        // Если есть данные переданные через $_POST, они загружены в модель и сохранены б БД, то...
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // Отправляем сообщение на почту
            $model->sendEmail();
            // Переходим на шаблон index
            return $this->redirect(['index']);
        } else {
            // Иначе отображаем шаблон добавления задачи и загружаем в него данные из модели (поля новой записи)
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    // Редактирование задачи
    public function actionUpdate($id = null) {
        // Находим запись по ключу
        $model = Task::findOne($id);
        // Если есть данные переданные через $_POST, они загружены в модель и сохранены б БД, то...
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // Отправляем сообщение на почту
            $model->sendEmail();
            // Переходим на шаблон index
            return $this->redirect(['index']);
        } else {
            // Иначе отображаем шаблон редактирования задачи и загружаем в него данные из модели (поля изменяемой записи)
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    // Удаление задачи
    public function actionRemove($id = null) {
        // Находим запись по ключу и удалаем её
        $model = Task::findOne($id)->delete();
        // Переходим на шаблон index
        return $this->redirect(['index']);
    }

    // Просмотр задачи
    public function actionReview($id = null) {
        // Находим запись по ключу
        $model = Task::findOne($id);
        // Отображаем её
        return $this->render('review', [
            'model' => $model,
        ]);
    }
}
