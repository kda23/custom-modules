<?php

namespace Drupal\events\Services;

use Drupal\Core\Entity\EntityTypeManager;
use Drupal\search\Plugin\SearchIndexingInterface;
use Drupal\search\SearchPluginManager;
use Drupal\search\SearchQuery;
use Symfony\Component\HttpFoundation\Response;
use \Drupal\Core\Entity\Query\QueryInterface;
use \Drupal\search\Controller\SearchController;
use \Drupal\search\SearchPageInterface;
use Drupal\node\Plugin\Search\NodeSearch;

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

    public function find($text, $entity_type = 'node')
    {
        $words = explode(' ', $text);
        // Get node id for every word from $text variable
        foreach ($words as $word) {
            $nid[] = \Drupal::entityQuery('node')->condition('title', $word, 'CONTAINS')->execute();
        }
        $result = [];
        $x = 0;
        // Serch by every word from $text variable
        foreach ($nid as $nids) {
            foreach ($nids as $nidsNode) {
                $result[] = $this->etm->getStorage('node')->load($nidsNode)->getTitle();
            }
        }
        return $result;
    }

    public function smartSearch($text = 'Article 1') {
        $query = \Drupal\search_api\Entity\Index::load('default_index')->query();
        $query->addCondition('search_api_language', 'en');
        $query->keys('Article');
        $query->range(0, 25);
        $data = $query->execute();
        $results = $data->getResultItems();
        $entities = [];
        foreach($results as $result) {
            $entities[] = $result->getOriginalObject()->get('nid')->value;
        }
        $entityId = reset($entities);
        $entity = $this->etm->getStorage('node')->load($entityId);
        $title[] = $entity->title->value;

        return $title;
    }
//    public function view(Request $request, SearchPageInterface $entity) {
//        $build = parent::view($request, $entity);
//        // Unset the Result title.
//        if (isset($build['search_results_title'])) {
//            unset($build['search_results_title']);
//        }
//        return $build;
//    }

//    public static function create(ContainerInterface $container)
//    {
//        $generator = $container->get('entity.query');
//        return new static($generator);
//    }

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

