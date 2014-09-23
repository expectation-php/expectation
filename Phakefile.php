<?php

namespace expect\spec;

require_once __DIR__ . "/vendor/autoload.php";

use Preview\Command;
use coverallskit\Configuration;
use coverallskit\ReportBuilder;
use phake\Application;

group('spec', function() {

    desc('Run the all unit test');
    task('all', function() {
        $command = new Command;
        $command->run(array(
            '-c', 'config/default.php',
            'spec'
        ));
    });

    desc('Run the unit test of class');
    task('run', function(Application $app) {
        $className = $app['class'];

        $command = new Command;
        $command->run(array(
            '-c', 'config/default.php',
            '-r', 'tree',
            realpath(__DIR__ . '/spec/' . $className . 'Spec.php')
        ));
    });

    desc('Send coveralls report');
    task('coveralls', function() {
        $configuration = Configuration::loadFromFile('.coveralls.yml');
        $builder = ReportBuilder::fromConfiguration($configuration);
        $builder->build()->save()->upload();
    });

});
