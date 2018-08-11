<?php 
use yii\helpers\Url;

?>

<aside class="main-sidebar">

    <section class="sidebar">

        <?=
        dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'All Events', 'icon' => 'calendar', 'url' => ['/event'],],
                        ['label' => 'Create Event', 'icon' => 'plus', 'url' => ['event/create'],]                        
                    ],
                ]
        )
        ?>

    </section>

</aside>
