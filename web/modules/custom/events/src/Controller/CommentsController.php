<?php

namespace Drupal\events\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\events\Services\EventsBreadcrumbBuilder;
use Symfony\Component\HttpFoundation\Response;
use Drupal\events\Services\JsonServices;
use Drupal\node\NodeInterface;
use Drupal\comment\Entity;
use \Drupal\Core\Routing\RouteMatch;
use Symfony\Component\Routing\Route;

/**
 * Class CommentsController.
 */
class CommentsController extends ControllerBase
{

    public function commentsList($id) {
        $cids = \Drupal::entityQuery('comment')
            ->condition('entity_id', $id)
            ->condition('entity_type', 'node')
            ->sort('cid', 'DESC')
            ->execute();
        $comments = [];

        foreach($cids as $cid) {
           $comment = \Drupal\comment\Entity\Comment::load($cid);
           $status = $comment->get('status')->value;
            if ($status == true) {
                $comments[] = [
                    'uid' => $comment->getOwnerId(),
                    'subject' => $comment->get('subject')->value,
                    'body' => $comment->get('comment_body')->value,
                    'created' => date('m/d/Y', $comment->get('created')->value),
                ];
           }
        }
       return $this->publishComments($comments);
    }

    public function publishComments($comments) {
        return $build = [
            "#theme" => 'comments',
            "#comments" => $comments,
        ];
    }
}
