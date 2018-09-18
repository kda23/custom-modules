<?php

namespace Drupal\events\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\events\Services\WeekendDay;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Drupal\events\Services\EventServiceClass;

/**
 * Class EventsController.
 */
class WeekendDayController extends ControllerBase
{
    /**
     * @var Drupal\events\Services\EventServiceClass
     */
    private $generator;

    public function __construct(WeekendDay $generator)
    {
        $this->generator = $generator;
    }

    public function DayOff()
    {
        $message = $this->generator->isDayOff();
        $build = [
            "#markup" => $message,
        ];
        return $build;
    }

    public static function create(ContainerInterface $container)
    {
        $generator = $container->get('events.weekend');
        return new static($generator);
    }
}