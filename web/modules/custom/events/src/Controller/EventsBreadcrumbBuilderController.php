<?php

namespace Drupal\events\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\events\Services\EventsBreadcrumbBuilder;
use Drupal\events\Services\EventServiceClass;
use Drupal\events\Services\WeekendDay;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class EventsController.
 */
class EventsBreadcrumbBuilderController extends ControllerBase
{
//    private $generator;
//
//    public function __construct(EventsBreadcrumbBuilder $generator)
//    {
//        $this->generator = $generator;
//    }

    public function DayOff()
    {
//        $message = $this->generator->build();
        $breadcrumb = new EventsBreadcrumbBuilder();
        $mess = $breadcrumb->build();
        dump($mess);
        $build = [
            "#markup" => 'some',
        ];
        return $build;
    }

//    public static function create(ContainerInterface $container)
//    {
//        $services = $container->get('events.breadcrumb');
//        return new static($services);
//    }

}