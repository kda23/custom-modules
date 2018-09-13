<?php

namespace Drupal\events\Services;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class EventServiceClass.
 */
class EventServiceClass {

    // Массив с сообщениями.
    private $date;

    /**
     * {@inheritdoc}
     */
    public function __construct() {
        // Записываем сообщения в свойство.
        $this->dateTime();
        $this->getCurrentDate();
    }

    /**
     * Здесь мы просто задаем все возможные варианты сообщений.
     */
    public function dateTime() {
        $time = [
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'Phasellus maximus tincidunt dolor et ultrices.',
            'Maecenas vitae nulla sed felis faucibus ultricies. Suspendisse potenti.',
            'In nec orci vitae neque rhoncus rhoncus eu vel erat.',
            'Donec suscipit consequat ex, at ultricies mi venenatis ut.',
            'Fusce nibh erat, aliquam non metus quis, mattis elementum nibh. Nullam volutpat ante non tortor laoreet blandit.',
            'Suspendisse et nunc id ligula interdum malesuada.',
        ];
    }

//    /**
//     * Метод, который возвра
//     */
//    public function getRandomMessage() {
//        $random = rand(0, count($this->messages) - 1);
//        return $this->messages[$random];
//    }

    public function getCurrentDate() {
        return $date = date('Y-m-d H:i:s');
    }

    function events_preprocess_html(&$variables) {
        $random_message = \Drupal::service('eventsservice')->getRandomMessage();
        drupal_set_message("$random_message");
    }
}

