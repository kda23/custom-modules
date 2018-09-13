<?php
namespace Drupal\simple\Controller;

use Symfony\Component\HttpFoundation\Response;

class SimpleController
{
  public function faq() 
  {
    $items = [
        ['name' => 'Article one'],
        ['name' => 'Article two'],
        ['name' => 'Article three'],
        ['name' => 'Article four'],
    ];
//    return new Response("<button id='button'>Button</button>");
    return [
        '#theme' => 'article_list',
        '#items' => $items,
        '#title' => 'Our article list',
    ];
  }
}  