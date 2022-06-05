<?php
require_once 'vendor/autoload.php';

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;

class Route
{
  public function route()
  {
    $fileLocator = new FileLocator(array(__DIR__));
    $loader = new YamlFileLoader($fileLocator);
    $routes = $loader->load('routes.yaml');

    $context = new RequestContext();
    $context->fromRequest(Request::createFromGlobals());

    $matcher = new UrlMatcher($routes, $context);

    $args = $matcher->match($context->getPathInfo());
    $id = $args['id'] ?? null;

    list($controllerClassName, $action) = explode('::', $args['controller']);
    $controller = new $controllerClassName();
    $controller->{$action}($id);

  }
}