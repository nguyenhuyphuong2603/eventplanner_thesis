<?php

use app\models\EventSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */
/* @var $searchModel EventSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = Yii::t('app', 'All Events');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Event'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="row">
        <?php
        $events = $dataProvider->getModels();

        foreach ($events as $event) {

            $body = "<div>Event date : " . $event->event_date . "</div>"
                    . "<div>Description : " . substr($event->description,0,200).' ............' . "</div>";
            $footer = Html::a(Yii::t('app', 'More'), ['event/view', 'id' => $event->event_id], ['class' => 'btn btn-primary']);
            ?>
            <div class="col-md-4">
                <div class="box box-solid box-primary">
                    <div class="box-header">
                        <h3 class="box-title" style=" white-space: nowrap; 
                            width: 100%; 
                            overflow: hidden;
                            text-overflow: ellipsis;"><?php echo $event->name ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div style="min-height: 100px;max-height: 300px;word-wrap: break-word;overflow: hidden"><?php echo $body ?></div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <div><?php echo $footer ?></div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
            <?php
        }
        ?>
    </div>


