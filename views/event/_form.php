<?php

use app\models\Event;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Event */
/* @var $form ActiveForm */
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'event_date')->textInput() ?>

    <?= $form->field($model, 'creator_id')->hiddenInput(['value' => \Yii::$app->user->identity->user_id])->label(false); ?>

    <?= $form->field($model, 'reminder')->dropDownList(['1' => 'Yes', '0' => 'No']); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <!--<?= $form->field($model, 'event_status_id')->textInput() ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php
    
    $desc_id = Html::getInputId($model, 'description');
    $event_date_id = Html::getInputId($model, 'event_date');
    
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
