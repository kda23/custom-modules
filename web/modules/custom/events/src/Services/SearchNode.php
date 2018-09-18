<?php

namespace Drupal\events\Services;

use Drupal\Core\Entity\EntityTypeManager;
use Drupal\search\SearchPluginManager;
use Symfony\Component\HttpFoundation\Response;
use \Drupal\Core\Entity\Query\QueryInterface;

/**
 * Class NodesListServices.
 */
class SearchNode
{
    private $etm;
    private $generator;

    public function __construct(EntityTypeManager $entityTypeManager)
    {
        $this->etm = $entityTypeManager;
    }

    public function find($text, $entity_type = ‘node’) {
        $words = explode(' ', $text);
        $query = \Drupal::entityQuery('node')->condition('title', $text, 'CONTAINS');
        dump($query);
        $result = [];
        $x = 0;
        foreach ($words as $word) {
//            $result[] = $query = \Drupal::service('entity.query')
//                ->get('node')->condition('title', $text);
            $result[] = $this->etm->getStorage('node')->loadByProperties(['title' => $text]);
            $nodeTitle[] = $result[$x][1]->getTitle();
            $x++;
        }
        return $nodeTitle;
    }

    public static function create(ContainerInterface $container)
    {
        $generator = $container->get('entity.query');
        dump($generator);
        return new static($generator);
    }
//    public function find($text = 'Article', $entity_type = ‘node’)
//    {
//        $search = (explode( ' ', $text));
//        //Get node object
//        $node = \Drupal\node\Entity\Node::loadMultiple();
////        $query = \Drupal::entityQuery('node')->condition('title', '$text');
//        //Get node titles, create array of explode titles
//        foreach ($node as $nodes) {
//            $nodeTitle[] = $nodes->title->value;
//            $nodeArray[] = explode(' ',$nodeTitle[$x]);
//            $x++;
//        }
//        //Search matches between words in arrays (titles and search string)
//        $countArr = count($nodeArray);
//        $countSearch = count($search);
//        $countNode = count($nodeTitle);
//        for ($x = 0; $x < $countNode; $x++) {
//            for ($y = 0; $y < $countSearch; $y++) {
//                for ($z = 0; $z < $countArr; $z++) {
//                    if ($search[$y] == $nodeArray[$x][$z]) {
//                        $count[$x] += 1;
//                    }
//                }
//            }
//        }
//        //Gets the node titles in the order specified by the number of words matching
//        arsort(($count));
//        foreach ($count as $key => $value) {
//            $nodesTitle[] = $nodeTitle[$key];
//        }
//        return $nodesTitle;
//    }
}

