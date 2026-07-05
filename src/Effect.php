<?php

$Effect_pureE = function($x) { return function() use(&$x) { return $x; }; };
$Effect_bindE = function($a, $f = null) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Effect_bindE;
            return $Effect_bindE(...array_merge($__args, $more));
        };
    }
    return function() use(&$a, &$f) { return $f($a())(); };
};