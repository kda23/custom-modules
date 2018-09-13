<?php
namespace Drupal\simple\Controller;

use Symfony\Component\HttpFoundation\Response;

class SimpleController
{
  public function faq() 
  {
    return new Response("<button id='button'>Button</button>");
  }
}  