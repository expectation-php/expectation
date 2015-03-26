<?php

use Evenement\EventEmitterInterface;
use Doctrine\Common\Annotations\AnnotationRegistry;
use cloak\peridot\CloakPlugin;

AnnotationRegistry::registerLoader(function($class) {
    $matchStrings = [ "expectation\\", '\\' ];
    $replaceStrings = [ "", '/' ];

    $classPath = str_replace($matchStrings, $replaceStrings, $class);
    $sourcePath = __DIR__ . "/" . $classPath . ".php";

    if (!is_file($sourcePath)) {
        return false;
    }
    require_once $sourcePath;
    return true;
});

return function(EventEmitterInterface $emitter) {
    if (defined('HHVM_VERSION') === false) {
        CloakPlugin::create('.cloak.toml')->registerTo($emitter);
    }
};
