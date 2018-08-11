<?php

use app\models\Event;
use app\models\Task;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Task */
/* @var $form ActiveForm */


$events = Event::find()->all();

$event_dropdown = array();

foreach ($events as $loop_event) {
    $event_dropdown[$loop_event->event_id] = $loop_event->name;
}
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'duedate')->textInput()->label('Due date') ?>

    <?= $form->field($model, 'reminder')->dropDownList(['1' => 'Yes', '0' => 'No']); ?>

    <?= $form->field($model, 'event_id')->hiddenInput(['value'=> $event->event_id])->label(false); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['event/view', 'id' => $event->event_id], ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php
    $desc_id = Html::getInputId($model, 'description');
    $event_date_id = Html::getInputId($model, 'duedate');

    $js = <<<EOD
        $('#$desc_id').wysihtml5({
        "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
        "emphasis": true, //Italics, bold, etc. Default true
        "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
        "html": true, //Button which allows you to edit the generated HTML. Default false
        "link": false, //Button to insert a link. Default true
        "image": false, //Button to insert an image. Default true,
        "color": false, //Button to change color of font  
        "blockquote": true, //Blockquote
        });
        $('#$event_date_id').datepicker({
            format: 'yyyy-mm-dd'
        });
EOD;

    $this->registerJs($js, View::POS_READY, 'editor-init');
    ?>
</div>
