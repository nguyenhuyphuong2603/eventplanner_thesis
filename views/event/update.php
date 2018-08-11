<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Event */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
            'modelClass' => 'Event',
        ]) . $model->name;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Events'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->event_id]];
//$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="event-update">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
