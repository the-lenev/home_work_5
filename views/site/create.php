<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Добавить задачу';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<?=
$this->render('_form', [
    'model' => $model,
])
?>
