<?php

$pureE = function($x) use (&$pureE) { return function() use(&$x) { return $x; }; };
$bindE = function($a, $f = null) use (&$bindE) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$bindE) {

            return $bindE(...array_merge($__args, $more));
        };
    }
    return function() use(&$a, &$f) { return $f($a())(); };
};

$exports['pureE'] = $pureE;
$exports['bindE'] = $bindE;
return $exports;
