<?php

$pureE = function ($x) {
    return function () use ($x) {
        return $x;
    };
};
$bindE = function ($a, $f) {
    return function () use ($a, $f) {
        $a_res = $a();
        $res = $f($a_res);
        return $res();
    };
};

$untilE = function ($f) {
    return function () use ($f) {
        while (!$f()) {
        }
    };
};

$whileE = function ($f, $a) {
    return function () use ($f, $a) {
        while ($f()) {
            $a();
        }
    };
};

$forE = function ($lo, $hi, $f) {
    return function () use ($lo, $hi, $f) {
        for ($i = $lo; $i < $hi; $i++) {
            $f($i)();
        }
    };
};

$foreachE = function ($as, $f) {
    return function () use ($as, $f) {
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
