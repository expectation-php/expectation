<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expectation;

use Doctrine\Common\Annotations\AnnotationRegistry;

AnnotationRegistry::registerLoader(function($class) {
    $matchStrings = [__NAMESPACE__ . "\\", '\\'];
    $replaceStrings = ["", '/'];

    $classPath = str_replace($matchStrings, $replaceStrings, $class);
    $sourcePath = __DIR__ . "/" . $classPath . ".php";

    if (!is_file($sourcePath)) {
        return false;
    }
    require_once $sourcePath;
    return true;
});
