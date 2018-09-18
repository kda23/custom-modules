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
    /**
     * @var Drupal\events\Services\NodesListServices
     */
    private $generator;

    public function __construct(NodesListServices $generator)
    {
        $this->generator = $generator;
    }

    public function latestNodes()
    {
        $node = $this->generator->latestNodes();
        return [
            '#type' => 'markup',
            '#list' => $node,
            '#theme' => 'article_list',
        ];
    }
}
