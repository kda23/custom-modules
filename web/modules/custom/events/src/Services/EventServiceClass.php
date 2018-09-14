<?php

namespace Drupal\events\Services;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class EventServiceClass.
 */
class EventServiceClass
{

    // Arrays with data
    private $date;
    private $nodes;
    private $time;

    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        // Push functions to controller.
        $this->time();
        $this->getCurrentDate();
    }

    public function getCurrentDate()
    {
        return $date = date('Y-m-d H:i:s');
    }

    public function time()
    {
        return $time = date('H:i:s');
    }
}

