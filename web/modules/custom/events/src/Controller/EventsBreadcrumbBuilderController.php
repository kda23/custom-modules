<?php
//
//namespace Drupal\events\Controller;
//
//use Drupal\Core\Breadcrumb\Breadcrumb;
//use Drupal\Core\Controller\ControllerBase;
//use Drupal\Core\Routing\RouteMatchInterface;
//use Drupal\events\Services\EventsBreadcrumbBuilder;
//use Drupal\events\Services\EventServiceClass;
//use Drupal\events\Services\WeekendDay;
//use Symfony\Component\DependencyInjection\ContainerInterface;
//use Symfony\Component\HttpFoundation\Response;
//
//
///**
// * Class EventsController.
// */
//class EventsBreadcrumbBuilderController extends ControllerBase
//{
//////    private $generator;
//////
//////    public function __construct(EventsBreadcrumbBuilder $generator)
//////    {
//////        $this->generator = $generator;
//////    }
//////
//////    public function DayOff()
//////    {
//////        $mess = $breadcrumb->build();
//////        dump($mess);
//////        $build = [
//////            "#markup" => 'some',
//////        ];
//////        return $build;
//////    }
//////
//////    public static function create(ContainerInterface $container)
//////    {
//////        $services = $container->get('events.breadcrumb');
//////        return new static($services);
//////    }
////
////
////
////    public function DayOff(RouteMatchInterface $route_match) {
////        $breadcrumb = new Breadcrumb();
////        $breadcrumb
////            ->addCacheContexts([
////                'route',
////            ]);
////        $breadcrumb
////            ->addLink(Link::createFromRoute($this
////                ->t('Home'), '<front>'));
////        $entity = $route_match
////            ->getParameter('entity');
////        $breadcrumb
////            ->addLink(new Link($entity
////                ->label(), $entity
////                ->urlInfo()));
////        $breadcrumb
////            ->addCacheableDependency($entity);
////        if (($pid = $route_match
////                ->getParameter('pid')) && ($comment = $this->storage
////                ->load($pid))) {
////
////            /** @var \Drupal\comment\CommentInterface $comment */
////            $breadcrumb
////                ->addCacheableDependency($comment);
////
////            // Display link to parent comment.
////            // @todo Clean-up permalink in https://www.drupal.org/node/2198041
////            $breadcrumb
////                ->addLink(new Link($comment
////                    ->getSubject(), $comment
////                    ->urlInfo()));
////        }
////        dump($breadcrumb);
////        return $breadcrumb;
////    }
//}