<?php

/**
 * Description of Router
 *
 * @author kuba
 */
class Router
{

	private $routes;

	public function __construct($routingFile)
	{
		if (!file_exists($routingFile)) {
			throw new Exception('Routing file not found');
		}
		$routes = array();
		require $routingFile;
		$this->routes = $routes;
	}

	public function route(Request $request)
	{
		$url = $request->getUrl();

		if (!isset($this->routes[$url[0]])) {
			throw New Exception('Route "' . $url[0] . '" not specified');
		}

		$route = $this->routes[$url[0]];

		$controller = new $route['controller']();

		if (!isset($url[1])) {
			if (!isset($route['defaultAction'])) {
				throw new Exception('No default action specified');
			} else {
				$action = $route['defaultAction'] . 'Action';
				$routeParameters = array();
			}
		} else {
			if (!isset($route['actions'][$url[1]])) {
				throw new Exception('Action "' . $url[1] . '" for route "' . $url[0] . '" not specified');
			}
			$action = $url[1] . 'Action';
			$routeParameters = $route['actions'][$url[1]];
		}
		if (!method_exists($controller, $action)) {
			throw new Exception('Method "' . $action . '" not found in "' . $route['controller'] . '"');
		}

		$reflection = new ReflectionMethod($route['controller'], $action);
		$methodParameters = $reflection->getParameters();

		$parameters = array();

		for ($i = 0; $i < count($methodParameters); $i++) {
			$param = $methodParameters[$i];
			/* @var $param ReflectionParameter */
			$paramName = $param->getName();

			if (in_array($paramName, $routeParameters)) {
				$position = array_search("$paramName", array_keys($routeParameters));
				if (isset($url[$position + 2])) {
					$parameters[] = $url[$position + 2];
					continue;
				}
			}

			if (!$param->isOptional()) {
				throw new Exception('Argument "' . $paramName . '" not specified for method "' . $route['controller'] . '::' . $action . '"');
			} else {
				break;
			}
		}

		$reflection->invokeArgs($controller, $parameters);
	}

}

?>
