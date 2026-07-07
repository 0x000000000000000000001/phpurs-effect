<?php

$exports = [];

for ($i = 1; $i <= 10; $i++) {
    $exports["mkEffectFn$i"] = function($fn) use ($i) {
        return function(...$args) use ($fn) {
            $curr = $fn;
            foreach ($args as $arg) {
                $curr = $curr($arg);
            }
            return $curr();
        };
    };

    $exports["runEffectFn$i"] = function($fn) use ($i) {
        $curry = function($argsLeft, $collectedArgs) use (&$curry, $fn) {
            if ($argsLeft === 0) {
                return function() use ($fn, $collectedArgs) {
                    return $fn(...$collectedArgs);
                };
            }
            return function($arg) use (&$curry, $argsLeft, $collectedArgs) {
                $collectedArgs[] = $arg;
                return $curry($argsLeft - 1, $collectedArgs);
            };
        };
        return $curry($i, []);
    };
}

return $exports;
