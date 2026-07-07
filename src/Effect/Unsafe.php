<?php

$exports['unsafePerformEffect'] = function($f) {
  return $f();
};

return $exports;
