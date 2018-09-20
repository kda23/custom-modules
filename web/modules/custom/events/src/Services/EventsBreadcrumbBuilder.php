<?php
//namespace Drupal\events\Services;
//
//use Drupal\Core\Breadcrumb\Breadcrumb;
//use Drupal\Core\Breadcrumb\BreadcrumbBuilderInterface;
//use Drupal\Core\Routing\RouteMatchInterface;
//use Drupal\Core\Link;
//use Drupal\Core\StringTranslation\StringTranslationTrait;
//use Drupal\node\NodeInterface;
//use Drupal\taxonomy\Entity\Term;
////use Drupal\Core\Routing\RouteMatchInterface;
//
//
//class EventsBreadcrumbBuilder implements BreadcrumbBuilderInterface
//{
//    /**
//     * {@inheritdoc}
//     */
//    public function applies(RouteMatchInterface $attributes)
//    {
//        $parameters = $attributes->getParameters()->all();
//        if (!empty($parameters['node'])) {
//            return $parameters['node']->getType() == 'article';
//        }
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    public function build(RouteMatchInterface $route_match)
//    {
//        $breadcrumb = new Breadcrumb();
//        $breadcrumb->addLink(Link::createFromRoute('Home', ''));
//        $breadcrumb->addLink(Link::createFromRoute('Article', '>>
//'));
//        return $breadcrumb;
//    }
//}
//
////    # Необходимо чтобы использовать $this->t().
////    use StringTranslationTrait;
////
////    /**
////     * {@inheritdoc}
////     */
////    public function applies(RouteMatchInterface $route_match) {
////        $node = $route_match->getParameter('node');
////        # Только если мы находимся на странице сущности node типа article.
////        return $node instanceof NodeInterface && $node->getType() == 'article';
////    }
////
////    /**
////     * {@inheritdoc}
////     */
////    public function build(RouteMatchInterface $route_match)
////    {
////        $breadcrumb = new Breadcrumb();
////        $node = $route_match->getParameter('node');
////        # Добавляем первую крошку на главную страницу.
////        $links = [Link::createFromRoute($this->t('Home'), '<front>')];
////        # Вторую крошку добавляем если категория задана в поле field_category.
//////        if (!$node->field_category->isEmpty()) {
//////            $tid = $node->field_category->target_id;
//////            $category_term = Term::load($tid);
//////            # Добавляем хлебную крошку на страницу термина.
//////            $links[] = Link::createFromRoute($category_term->name->value, 'entity.taxonomy_term.canonical', ['taxonomy_term' => $tid]);
//////        }
////        # Указываем контекст для кэширования данной хлебной крошки. В нашем случае
////        # будет кэшироваться только для текущего адреса url.
////        $breadcrumb->addCacheContexts(['url.path']);
////        return $breadcrumb->setLinks($links);
////    }
//
////}
//
/////**
//// * @file
//// * Contains \Drupal\current_page_crumb\BreadcrumbBuilder.
//// */
////namespace Drupal\events\Services;
////
////use Drupal\Core\Link;
////use Drupal\Core\Routing\RouteMatchInterface;
////use Drupal\Component\Utility\Unicode;
////use Drupal\system\PathBasedBreadcrumbBuilder;
////use Symfony\Cmf\Component\Routing\RouteObjectInterface;
/////**
//// * Adds the current page title to the breadcrumb.
//// *
//// * Extend PathBased Breadcrumbs to include the current page title as an unlinked
//// * crumb. The module uses the path if the title is unavailable and it excludes
//// * all admin paths.
//// *
//// * {@inheritdoc}
//// */
////class EventsBreadcrumbBuilder extends PathBasedBreadcrumbBuilder {
////    /**
////     * {@inheritdoc}
////     */
////    public function build(RouteMatchInterface $route_match) {
////        $breadcrumbs = parent::build($route_match);
////        $request = \Drupal::request();
////        dump($request);
////        $path = trim($this->context->getPathInfo(), '/');
////        $path_elements = explode('/', $path);
////        $route = $request->attributes->get(RouteObjectInterface::ROUTE_OBJECT);
////        // Do not adjust the breadcrumbs on admin paths.
////        if ($route && !$route->getOption('_admin_route')) {
////            $title = $this->titleResolver->getTitle($request, $route);
////            if (!isset($title)) {
////                // Fallback to using the raw path component as the title if the
////                // route is missing a _title or _title_callback attribute.
////                $title = str_replace(array('-', '_'), ' ', Unicode::ucfirst(end($path_elements)));
////            }
////            $breadcrumbs->addLink(Link::createFromRoute($title, '<none>'));
////        }
////        return $breadcrumbs;
////    }
//
////    public function build($route_match) {
////        $b = new Breadcrumb();
////
//////        $node = $route_match->getParameter('node');
////
////            $b->addLink(Link::createFromRoute(t('Blog'), 'blog.home'));
////            $b->addLink(Link::createFromRoute(t('Recipes'), 'blog.recipes_landing'));
////
////            //I want this next item to not be a link, and to show "Recipe" and not the node title.
////            $b->addLink(Link::createFromRoute(t('Recipe'), '<none>'));
////
////        return $b;
////    }
////}
//
