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
        )->textInput()->label(Yii::t('app', 'Date'));
        ?>
        <?=
        // Добавляем поле, соответствующее полю 'text' в таблице и устанавливаем его описание (метку)
        $form->field($model, 'text')->label(Yii::t('app', 'Task'));
        ?>
        <?=
        // Добавляем поле для комментария
        $form->field($model, 'comment')->textArea(['rows' => 3, 'cols' => 5])->label(Yii::t('app', 'Comment'));
        ?>

        <div class="form-group">
            <?=
            // Добавляем кнопку отправки формы
            // В зависимости от типа записи (новая/редактирование) меняем её описание и цвет
            Html::submitButton($model->isNewRecord ? Yii::t('app', 'Add') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])
            ?>
        </div>

    <?php
    // Закрываем форму
    ActiveForm::end(); ?>
</div>
