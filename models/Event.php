<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use app\models\base\BaseEvent;
use Yii;

class Event extends BaseEvent {

    public function sendMailToCreator() {

        $to = $this->creator->profile->email;

        Yii::$app->mail->compose('@app/mail/layouts/event_create_email', [
                    'event_name' => $this->name,
                    'event_date' => $this->event_date,
                    'event_desc' => $this->description
                ])
                ->setFrom(Yii::$app->params['adminEmail'])
                ->setTo($to)
                ->setSubject('You have created new event')
                ->send();
    }

}
