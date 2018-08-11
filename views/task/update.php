<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Task */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Task',
]) . $model->name;
?>
<div class="task-update">
    
    <?= $this->render('_form', [
        'model' => $model,
        'event' => $model->event
    ]) ?>

</div>
