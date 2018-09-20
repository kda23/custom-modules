<?php

namespace Drupal\events\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\events\Services\SearchNode;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouteCollection;

/**
 * Class EventsController.
 */

class SearchNodeController extends ControllerBase
{
    /**
     * @var Drupal\events\Services\SearchNode
     */
    private $generator;

    public function __construct($generator)
    {
        $this->generator = $generator;
    }

    public function searchNodes()
    {
        $text = 'Article 1';
//        $searchResult = $this->generator->find($text, 'node');
        $searchResult = $this->generator->smartSearch();

//        $searchResult = $this->generator->smartSearch($text);
        $build = [
            '#result' =>  $searchResult,
            '#theme' => 'search_nodes',
            '#cache' => [
                'max-age' => 150,
            ],
        ];
        return $build;
    }

    public static function create(ContainerInterface $container)
    {
        $generator = $container->get('events.search_nodes');
        return new static($generator);
    }
}