<?php

namespace Drupal\events\Services;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Drupal\events\Services\JsonServices;

/**
 * Class JsonServices.
 */
class JsonServices
{

  /**
   * Constructs a new JsonServices object.
   */
  public function generate()
  {
    $node = \Drupal\node\Entity\Node::loadMultiple();
    foreach ($node as $nodes) {
        $nodeArray[] = $nodes->nid->value;
        $nodeArray[] = $nodes->title->value;
        $nodeArray[] = $nodes->type->target_id;
    }
    $json = \GuzzleHttp\json_encode($nodeArray);
    $response = Response::create($json);
    $response->headers->set('Content-type', 'application/json');
    return $response;
  }
}
