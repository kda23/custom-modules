<?php

namespace Drupal\events\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Drupal\events\Services\EventServiceClass;

/**
 * Class EventsController.
 */

class EventsController extends ControllerBase
{

    /**
     * @var Drupal\events\Services\EventServiceClass
     */
    private $generator;

    public function __construct(EventServiceClass $generator)
    {
        $this->generator = $generator;
    }

  public function hello()
  {
      $date = $this->generator->getCurrentDate();
      $build = [
              '#date' =>  $date,
              '#theme' => 'article_list',
              '#cache' => [
                'context' => ['user'],
                'max-age' => 150,
                ],
      ];
//      $build['#cache']['max-age'] = 300;
////      $build['#markup'] = time();
//      $response = Response::create($date);
//      $response->headers->set('Cache-Control', 'max-age=150');
      return $build;
  }

  public function titleTeamplate ()
  {
     $time = $this->generator->time();
     $title = "My page. Generated at $time";
     return $title;
  }

  public static function create(ContainerInterface $container)
  {
    $services = $container->get('events.performance_tasks');
    return new static($services);
  }
}
