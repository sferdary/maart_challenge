<?php

class Route
{
    public static $validRoutes = array();

    public static function createView($route, $function) {
        self::$validRoutes[] = $route;
        if (url == $route) {
            $function->__invoke();
        }
    }
}