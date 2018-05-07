<?php

if (! function_exists('isActiveRoute')) {

    /**
     * [Description of this function]
     *
     * @param $route
     * @param string $output
     * @return string
     */
    function isActiveRoute($route, $output = 'active')
    {
        if (Route::currentRouteName() == $route) {
            return $output;
        }
    }
}