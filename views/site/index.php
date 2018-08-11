<?php

/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '';
$user = \Yii::$app->user->identity;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome <?php echo $user->username?> to The Event Planner !</h1>

        <p class="lead">Get your events planned !</p>

        <p><a class="btn btn-lg btn-warning" href="<?php echo Url::to(['event/create', 'id' => $user->id]) ?>">Click here to start creating your event</a></p>
    </div>

    
</div>
