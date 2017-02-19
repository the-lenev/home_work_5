<?php
// Подключаем класс для работы с разметкой
use yii\helpers\Html;
// Подключаем класс для создания ссылок
use yii\helpers\Url;


// Устанавливаем title
$this->title = Yii::t('app', 'View task');
// Добавляем title в дорогу (хлебные крошки)
$this->params['breadcrumbs'][] = $this->title;
?>
    <!-- Отображыем title -->
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    // Для указнной записи выводим значения полей, в соответствующие места в разметке
    // Ссылки указывают на действия контроллера, которые нужно выполнить, и ключи записей, к которым их нужно применить
    ?>
        <div class='list-group-item clearfix'>
            <div class="col-sm-2">
                <?= $model['date']?>
            </div>
            <div class="col-sm-8">
                <?= $model['text']?>
            </div>
            <div class="col-sm-1">
                <a href="<?= Url::to(['site/update', 'id' => $model['id']])?>">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
            </div>
            <div class="col-sm-1">
                <a href="<?= Url::to(['site/remove', 'id' => $model['id']])?>">
                    <span class="glyphicon glyphicon-trash">
                </a>
            </div>
        </div>
        <?php
        // Если поле Комментарий заполнено, то выводим его
        if ($model['comment']) {?>
            <h3><?= $model->getAttributeLabel('comment')?></h3>
            <p><?= $model['comment']?></p>
        <?php }?>
    <a class="btn btn-success" href="<?= Url::to(['site/'])?>">
        <?= Yii::t('app', 'Return to list')?>
    </a>
</div>
