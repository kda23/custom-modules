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
    $array = [1 => 'drupal', 2 => 'joomla', 3 => 'wordpress', 4 => $date];
    $json = \GuzzleHttp\json_encode($array);
    $response = Response::create($json);
    $response->headers->set('Content-type', 'application/json');
    $response->headers->set('Cache-Control', 'max-age=100000, public');
    return $response;







      $comment = \Drupal::entityManager()->getStorage('comment');
  }
}
