<?php

$pureE = function($x) { return function() use($x) { return $x; }; };
$bindE = function($a, $f = null) use (&$bindE) {
    if (\func_num_args() < 2) {
        $__args = \func_get_args();
        return function(...$more) use ($__args, &$bindE) {
            return $bindE(...\array_merge($__args, $more));
        };
    }
    return function() use($a, $f) {
        $a_res = $a();
        $res = $f($a_res);
        return $res();
    };
};

$untilE = function($f) {
    return function() use ($f) {
        while (!$f()) {}
    };
};

$whileE = function($f, $a = null) use (&$whileE) {
    if (\func_num_args() < 2) {
        $__args = \func_get_args();
        return function(...$more) use ($__args, &$whileE) {
            return $whileE(...\array_merge($__args, $more));
        };
    }
    return function() use ($f, $a) {
        while ($f()) {
            $a();
        }
    };
};

$forE = function($lo, $hi = null, $f = null) use (&$forE) {
    if (\func_num_args() < 3) {
        $__args = \func_get_args();
        return function(...$more) use ($__args, &$forE) {
            return $forE(...\array_merge($__args, $more));
        };
    }
    return function() use ($lo, $hi, $f) {
        for ($i = $lo; $i < $hi; $i++) {
            $f($i)();
        }
    };
};

$foreachE = function($as, $f = null) use (&$foreachE) {
    if (\func_num_args() < 2) {
        $__args = \func_get_args();
        return function(...$more) use ($__args, &$foreachE) {
            return $foreachE(...\array_merge($__args, $more));
        };
    }
    return function() use ($as, $f) {
        foreach ($as as $a) {
            $f($a)();
        }
    };
};

$exports['pureE'] = $pureE;
$exports['bindE'] = $bindE;
$exports['untilE'] = $untilE;
$exports['whileE'] = $whileE;
$exports['forE'] = $forE;
$exports['foreachE'] = $foreachE;

return $exports;
