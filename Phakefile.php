<?php

namespace expect\spec;

require_once __DIR__ . "/vendor/autoload.php";

use Preview\Command;
use phake\Application;

group('spec', function() {

    desc('Run the all unit test');
    task('all', function() {
        $command = new Command;
        $command->run(array(
            '-c', 'preview.config.php',
            'spec'
        ));
    });

    desc('Run the unit test of class');
    task('run', function(Application $app) {
        $className = $app['class'];

        $command = new Command;
        $command->run(array(
            '-c', 'preview.config.php',
            '-r', 'tree',
            realpath(__DIR__ . '/spec/' . $className . 'Spec.php')
        ));
    });

});
