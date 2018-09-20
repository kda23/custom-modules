<?php

namespace Drupal\events\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Drupal\events\Services\EventService;
use Drupal\mymodule\Breadcrumb\MymoduleBreadcrumbBuilder;

/**
 * Class EventsController.
 */

class EventsController extends ControllerBase
{

    /**
     * @var Drupal\events\Services\EventServiceClass
     */
    private $generator;

    public function __construct(EventService $generator)
    {
        $this->generator = $generator;
    }

  public function hello()
  {

      $date = $this->generator->getCurrentDate();
      $renderable = [
              '#date' =>  $date,
              '#theme' => 'article_list',
              '#cache' => [
                'context' => ['user'],
                'max-age' => 150,
                ],
              '#test_var' => 'test variable',
      ];
//      $response->headers->set('Cache-Control', 'max-age=150');
      $rendered = \Drupal::service('renderer')->render($renderable);
      return [
          '#markup' => $rendered,
      ];
  }

  public function titleTeamplate ()
  {
     $time = $this->generator->time();
     $title = "My page. Generated at $time";
     return $title;
  }

  public static function create(ContainerInterface $container)
  {
    $generator = $container->get('events.performance_tasks');
    return new static($generator);
  }
}
