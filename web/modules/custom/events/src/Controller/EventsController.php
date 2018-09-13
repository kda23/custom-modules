<?php

namespace Drupal\events\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Drupal\events\Services\EventServiceClass;

/**
 * Class EventsController.
 */

class EventsController extends ControllerBase {

    /**
     * @var Drupal\events\Services\EventServiceClass
     */
    private $generator;
    private $build;

    public function __construct(EventServiceClass $generator) {
        $this->generator = $generator;
    }

  public function hello() {
      $date = $this->generator->getCurrentDate();
      $build = [
              '#markup' => time(),
              '#theme' => 'article_list',
              'some' => 'string',
              '#cache' => [
                  'tags' => \Drupal::entityTypeManager()->getStorage('user')->load(1)->getCacheTags(),
                  'context' => ['user'],
                  'max-age' => 10000,
              ],
      ];
//    dump($build);
    $this->build = $build;
    return $this->build;
//    return [
//
//      '#items' => $items,
//    ];
  }

  public static function create(ContainerInterface $container) {
    $services = $container->get('events.performance_tasks');
    return new static($services);
  }
}
