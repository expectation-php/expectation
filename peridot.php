<?php

use Evenement\EventEmitterInterface;
use cloak\Analyzer;
use cloak\configuration\ConfigurationLoader;
use Doctrine\Common\Annotations\AnnotationRegistry;

AnnotationRegistry::registerLoader(function($class) {
    $matchStrings = [ "expectation\\", '\\' ];
    $replaceStrings = [ "", '/' ];

    $classPath = str_replace($matchStrings, $replaceStrings, $class);
    $sourcePath = __DIR__ . "/" . $classPath . ".php";

    if (!is_file($sourcePath)) {
        var_dump($sourcePath);
        return false;
    }
    require_once $sourcePath;
    return true;
});

return function(EventEmitterInterface $emitter) {

    $configLoader = new ConfigurationLoader();
    $config = $configLoader->loadConfiguration('cloak.toml');
    $analyzer = new Analyzer($config);

    $emitter->on('peridot.start', function() use ($analyzer) {
        $analyzer->start();
    });

    $emitter->on('peridot.end', function() use ($analyzer) {
        $analyzer->stop();
    });

};
