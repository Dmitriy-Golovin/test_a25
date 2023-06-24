<?php
class Routing {

    public static function buildRoute() {

        /* Контроллер и action по умолчанию */
        $controllerName = "IndexController";
        $action = "index";

        $route = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $i = count($route) - 1;

        while ($i > 0) {
            if (!empty($route[$i])) {
                if (is_file(CONTROLLER_PATH . ucfirst($route[$i]) . "Controller.php")) {
                    $controllerName = ucfirst($route[$i]) . "Controller";
                    break;
				} else {
					$action = $route[$i];
                }
            }
            $i--;
        }

        require_once CONTROLLER_PATH . preg_replace('/Controller/', '', $controllerName) . "Controller.php";

        $controller = new $controllerName($_SERVER['REQUEST_METHOD'], $action);

		if (is_file(CONTROLLER_PATH . preg_replace('/Controller/', '', $controllerName) . "Controller.php") && method_exists($controller, $action)) {
			if (method_exists($controller, 'index')) {
				$controller->$action();
			} else if (!method_exists($controller, 'index') && isset($_POST['ajax'])) {
				$controller->$action();
			} else {
				self::errorPage();
			}
		} else {
			self::errorPage();
		}
    }

    private static function errorPage() {
		$controllerName = 'NotFoundController';
        $action = 'notFound';
		
		require_once CONTROLLER_PATH . $controllerName . ".php";

        $controller = new $controllerName($_SERVER['REQUEST_METHOD'], $action);
		$controller->$action();
    }
}