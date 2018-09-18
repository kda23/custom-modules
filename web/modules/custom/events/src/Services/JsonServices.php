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
    $date = date('H:i:s');
    $node = \Drupal\node\Entity\Node::loadMultiple();
    foreach ($node as $nodes) {
        $nodeArray[] = $nodes->title->value;
        $nodeArray1[] = $nodes->type->value;
        $nodeArray[] = $nodes->nid->value;
    }
    $json = \GuzzleHttp\json_encode($date);
    $response = Response::create($json);
//    $response->headers->set('Content-type', 'application/json');
    $response->headers->set('Cache-Control', "max-age=300, public");
    return $response;
  }
}
