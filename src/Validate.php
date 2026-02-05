<?php
namespace Moacir\Barramento;
use Exception;
class Validate
{
    public static function validate(array $request, array $controllers): void
    {
        if (!isset($request['controller']) || !isset($request['action'])) {
            throw new Exception("Controller e action são obrigatórios");
        }
        $controller = $request['controller'];
        if (!array_key_exists($controller, $controllers)) {
            throw new Exception("Controller inválido");
        }
        // $action = $request['action'];
        // if (!array_key_exists($action, $controllers[$controller]['method'])) {
        //     throw new Exception("Action inválida");
        // }
    }
}

