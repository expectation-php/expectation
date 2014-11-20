<?php

use Evenement\EventEmitterInterface;
use cloak\Analyzer;
use cloak\configuration\ConfigurationLoader;

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
