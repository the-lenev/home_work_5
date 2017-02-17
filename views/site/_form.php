<?php
// Подключаем класс для работы с разметкой
use yii\helpers\Html;
// Подключаем класс для работы с формами
use yii\bootstrap\ActiveForm;
// Класс для работы с датой
use yii\jui\DatePicker;
?>

<div class="row col-sm-12">
    <?php
    // Открываем форму
    $form = ActiveForm::begin(); ?>

        <?=
        // Добавляем поле, соответствующее полю 'date' в таблице и устанавливаем его описание (метку)
        $form->field($model, 'date')->widget(DatePicker::classname(), [
                'attribute' => 'date',
                'language' => 'ru',
                'dateFormat' => 'yyyy-MM-dd',
            ]
        )->textInput()->label('Дата');
        ?>
        <?=
        // Добавляем поле, соответствующее полю 'text' в таблице и устанавливаем его описание (метку)
        $form->field($model, 'text')->label('Задача'); ?>

        <div class="form-group">
            <?=
            // Добавляем кнопку отправки формы
            // В зависимости от типа записи (новая/редактирование) меняем её описание и цвет
            Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

    <?php
    // Закрываем форму
    ActiveForm::end(); ?>
</div>
