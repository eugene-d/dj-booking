<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Routing\Router;
use ReflectionClass;

class DashboardController extends Controller {
    /**
     * Show a list of API routes with attributes
     * @param Router $router
     * @return \Illuminate\View\View
     */
    public function index(Router $router) {
        $routes = $router->getRoutes();
        $routesData = [];

        foreach($routes as $route) {
            $action = $route->getActionName();
            $actionParts = explode('@', $action);
            $routeClassReflection = new ReflectionClass($actionParts[0]);
            $routeMethodReflection = $routeClassReflection->getMethod($actionParts[1]);

            array_push($routesData, (object)[
                'url' => $route->uri(),
                'method' => implode('|', $route->methods()),
                'action' => str_replace(['App\\Http\\Controllers\\'], '', $action),
                'docComment' => $this->getMethodInfo($routeMethodReflection),
                'verificationRules' => $this->getRequestValidationRules($routeMethodReflection)
            ]);
        }

        return view('dashboard', compact(['routesData']));
    }

    /**
     * Return clean method info for specified route
     * @param $reflection
     * @return string
     */
    private function getMethodInfo($reflection) {
        $string = str_replace(['/**', '*', '/'], '', $reflection->getDocComment());
        return trim(preg_replace('/(\@.*)/i', '', $string));
    }

    /**
     * Return request validation rules for specified route
     * @param $routeMethod
     * @return array
     */
    private function getRequestValidationRules($routeMethod) {
        foreach ($routeMethod->getParameters() as $param) {
            if (preg_match("/Requests/i", $param->getClass())) {
                $requestClassName = $param->getClass()->name;
                $requestClass = new $requestClassName;
                return $requestClass->rules();
            }
        }
        return [];
    }
}