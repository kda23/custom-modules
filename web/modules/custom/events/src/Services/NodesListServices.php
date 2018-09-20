<?php

namespace Drupal\events\Services;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class NodesListServices.
 */
class NodesListServices
{
    function latestNodes()
    {
        $startNode  =  strtotime("today", REQUEST_TIME);
        $query = \Drupal::entityQuery('node');
        $node_id = $query->condition('created', $startNode, '>=')->execute();
        $nodes = \Drupal::entityTypeManager()->getStorage('node')->loadMultiple($node_id);
        if ($nodes) {
            foreach ($nodes as $node) {
                $articleTitle = $node->title->value;
                $articleNid = $node->nid->value;
                $article[] = "$articleTitle" . ' - ' . "$articleNid";
            }
            return $article;
        }
    }
}

