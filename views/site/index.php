<?php
// Подключаем класс для работы с разметкой
use yii\helpers\Html;
// Подключаем класс для создания ссылок
use yii\helpers\Url;

// Устанавливаем title
$this->title = Yii::t('app', 'Task list');
// Добавляем title в дорогу (хлебные крошки)
$this->params['breadcrumbs'][] = $this->title;
?>
    <!-- Отображыем title -->
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="list-group">
    <?php
    // Для всех записей из таблицы выводим значения полей, в соответствующие места в разметке
    // Ссылки указывают на действия контроллера, которые нужно выполнить, и ключи записей, к которым их нужно применить
    foreach ($model as $task) {?>
        <div class='list-group-item clearfix'>
            <div class="col-sm-2"><?= $task['date']?></div>
            <div class="col-sm-8">
                <a href="<?= Url::to(['site/review', 'id' => $task['id']])?>">
                    <?= $task['text']?>
                </a>
            </div>
            <div class="col-sm-1">
                <a href="<?= Url::to(['site/update', 'id' => $task['id']])?>">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
            </div>
            <div class="col-sm-1">
                <a href="<?= Url::to(['site/remove', 'id' => $task['id']])?>">
                    <span class="glyphicon glyphicon-trash">
                </a>
            </div>
        </div>
    <?php }?>
    </div>
    <a class="btn btn-success" href="<?= Url::to(['site/create'])?>">
         <?= Yii::t('app', 'Add');?>
    </a>
</div>
