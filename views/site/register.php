<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this View */
/* @var $form ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign Up';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];

$fieldOptions3 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];
?>

<div class="login-box">
    <div class="login-logo">
        <b>EVENT PLANNER</b>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Register</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?=
                $form
                ->field($model, 'username', $fieldOptions1)
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('username')])
        ?>

        <?=
                $form
                ->field($model, 'email', $fieldOptions3)                
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('email')])
        ?>

        <?=
                $form
                ->field($model, 'password', $fieldOptions2)
                ->label(false)
                ->passwordInput(['placeholder' => $model->getAttributeLabel('password')])
        ?>

        <?=
                $form
                ->field($model, 'confirm_password', $fieldOptions2)
                ->label(false)
                ->passwordInput(['placeholder' => $model->getAttributeLabel('confirm_password')])
        ?>
        
         <?=
                $form
                ->field($model, 'firstname', $fieldOptions1)                
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('firstname')])
        ?>
        
         <?=
                $form
                ->field($model, 'lastname', $fieldOptions1)                
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('lastname')])
        ?>

        <div class="row">            
            <!-- /.col -->
            <div class="col-xs-4">
                <?= Html::submitButton('Sign up', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <div class="col-xs-4">
                <?=
                Html::a(
                        'Cancel', ['/site/login'], ['data-method' => 'get', 'class' => 'btn btn-danger btn-block btn-flat']
                )
                ?>
            </div>
            <!-- /.col -->
        </div>


<?php ActiveForm::end(); ?>       
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
<?php
$desc_id = Html::getInputId($model, 'description');
$event_date_id = Html::getInputId($model, 'event_date');

$js = <<<EOD
       $()
EOD;

echo $js;
?>
</div>
