<?php

namespace Drupal\events\Services;

use Drupal\Component\Datetime\Time;
use Drupal\Core\Datetime\DateFormatterInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class EventServiceClass.
 */
class EventService
{

    // Arrays with data
    private $dateFormatter;
    private $timestamp;

    /**
     * {@inheritdoc}
     */
    public function __construct(DateFormatterInterface $dateFormatter)
    {
        // Variables
        $this->dateFormatter = $dateFormatter;
        // Functions
        $this->timestamp();
    }

    private function timestamp()
    {
        $timestamp = \Drupal::time()->getRequestTime();
        $this->timestamp = $timestamp;
    }

    public function getCurrentDate()
    {
        return $date = $this->dateFormatter->format($this->timestamp, 'custom', 'Y-m-t');
    }

    public function time()
    {
        return $time = $this->dateFormatter->format($this->timestamp, 'custom', 'h:i:s');
    }
}