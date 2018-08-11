<?php

//use yii\widgets\DetailView;


use app\models\Event;
use kartik\detail\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */
/* @var $model Event */

$this->title = $model->name;
?>
<div class="event-view">

     <?= Html::a(Yii::t('app', 'Back to event dashboard'), ['event/index'], ['class' => 'btn btn-warning','style' => 'margin-bottom:10px']) ?>
    
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'event_id',
            'event_date',
            //'creator_id',
            [
                'attribute' => 'reminder',
                'label' => 'Reminder',
                'format' => 'raw',
                'value' => $model->reminder ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'
            ],
            'description:html',
        //'event_status_id',
        //'name',
        ],
    ]);

//    DetailView::widget([
//        'model' => $model,
//        'condensed' => true,
//        'bordered' => true,
//        'hover' => true,
//        'mode' => DetailView::MODE_VIEW,
//        'responsive' => true,
//        'panel' => [
//            'heading' => 'Book # ' . $model->event_id,
//            'type' => DetailView::TYPE_INFO,
//        ],
//        'attributes' => [
//            [
//                'attribute' => 'name',
//                'format' => 'text',
//                'label' => 'Event name'
//            ],
//            'event_date',
//            [
//                'attribute' => 'description',
//                'format' => 'html',
//                'value' => '<span class="text-justify">' . $model->description . '</span>',
//                'type' => DetailView::INPUT_TEXTAREA,
//                'options' => ['rows' => 4]
//            ],
//            [
//                'attribute' => 'reminder',
//                'label' => 'Reminder',
//                'format' => 'raw',
//                'value' => $model->reminder ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'
//            ]
//        ]
//    ]);
    ?>   

    <p>
       
        <?= Html::a(Yii::t('app', 'Update event'), ['update', 'id' => $model->event_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Create task'), ['task/create', 'event_id' => $model->event_id], ['class' => 'btn btn-primary']) ?>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eventDelete">
            Delete
        </button>

        <!-- Modal -->
    <div class="modal fade" id="eventDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete !</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you want to delete this event ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary deleteBtn" data-url='<?php echo Url::to(['event/delete', 'id' => $model->event_id]) ?>'>Yes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="taskDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete !</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you want to delete this task ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary deleteBtn" data-url=''>Yes</button>
                </div>
            </div>
        </div>
    </div>
</p>

<?php
$js = <<<EOD
    $(document).on('click','.deleteBtn',function(){
       document.location.href = $(this).data('url');
    });
        
    $('#taskDelete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var url = button.data('url') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.deleteBtn').data('url',url);
    })
EOD;

$this->registerJs($js, View::POS_READY, 'delete-btn-init');

$tasks = $model->tasks;

if (count($tasks) > 0) {
    echo '<hr style="border: 1px solid #ccc;">';

    echo '<table style="width:100%;margin-top:10px">';

    foreach ($tasks as $task) {

        $body = "<div>Due date : " . $task->duedate . "</div>"
                . "<div>Description : " . $task->description . "</div>";

        $footer = Html::a(Yii::t('app', 'Update task'), ['task/update', 'id' => $task->task_id], ['class' => 'btn btn-primary']);
        $footer .= ' <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#taskDelete" data-url="'.Url::to(['task/delete', 'id' => $task->task_id]).'">
            Delete
        </button>';

        echo '<div class="box box-solid box-success">
            <div class="box-header with-border">
                <h3 class="box-title">' . $task->name . '</h3>
                <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->

                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body" style="word-wrap: break-word;">
                ' . $body . '
            </div><!-- /.box-body -->
            <div class="box-footer">
                  ' . $footer . '
            </div><!-- box-footer -->            
        </div><!-- /.box -->';
    }

    echo '</table>';
}
?>
</div>
