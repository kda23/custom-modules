<?php

namespace Drupal\events\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Drupal\events\Services\JsonServices;

/**
 * Class JsonController.
 */
class JsonController extends ControllerBase {

  public function jsonNode()
  {
      $jsonServices = new JsonServices;
      $response = $jsonServices->generate();
      return $response;
  }
}
