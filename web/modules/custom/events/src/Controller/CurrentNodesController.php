<?php

namespace Drupal\events\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\events\Services\NodesListServices;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class CurrentNodesController.
 */
class CurrentNodesController extends ControllerBase
{
    // Services connected to controllerr
    private $generator;

    public function __construct(NodesListServices $generator)
    {
        $this->generator = $generator;
    }
  /**
   * Lastnode.
   *
   * @return string
   *   Return Hello string.
   */
    public function latestNodes()
    {
        $node = $this->generator->latestNodes();
        return [
            '#type' => 'markup',
            '#list' => $node,
            '#theme' => 'article_list',
        ];
    }

    public static function create(ContainerInterface $container)
    {
        $services = $container->get('events.latest_articles');
        return new static($services);
    }
}
