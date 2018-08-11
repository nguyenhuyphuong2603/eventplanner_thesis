<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Description of AdminLtePluginAsset
 *

 */
class AdminLtePluginAsset extends AssetBundle {

    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';
    public $js = [
        'bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
        'datepicker/bootstrap-datepicker.js',
            // more plugin Js here
    ];
    public $css = [
        'bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
        'datepicker/datepicker3.css',
            // more plugin CSS here
    ];
    public $depends = [
        'dmstr\web\AdminLteAsset',
    ];

}
