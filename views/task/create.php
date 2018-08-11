<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Task */

$this->title = Yii::t('app', 'Create Task');
?>
<div class="task-create">

    <?= $this->render('_form', [
        'model' => $model,
        'event' => $event
    ]) ?>

</div>
