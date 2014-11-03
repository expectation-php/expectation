<?php

use Evenement\EventEmitterInterface;
use cloak\Analyzer;
use cloak\ConfigurationBuilder;
use cloak\result\File;
use cloak\reporter\CompositeReporter;
use cloak\reporter\LcovReporter;
use cloak\reporter\MarkdownReporter;
use cloak\reporter\TextReporter;
use cloak\reporter\ProcessingTimeReporter;

return function(EventEmitterInterface $emitter) {

    $analyzer = Analyzer::factory(function(ConfigurationBuilder $builder) {
        $reporter = new CompositeReporter([
            new LcovReporter(__DIR__ . '/report.lcov'),
            new MarkdownReporter(__DIR__ . '/report.md'),
            new TextReporter(),
            new ProcessingTimeReporter()
        ]);

        $includeCallback = function(File $file) {
            return $file->matchPath('src');
        };

        $excludeCallback = function(File $file) {
            return $file->matchPath('vendor') || $file->matchPath('spec');
        };

        $builder->reporter($reporter)
            ->includeFile($includeCallback)
            ->excludeFile($excludeCallback);
    });

    $emitter->on('peridot.start', function() use ($analyzer) {
        $analyzer->start();
    });

    $emitter->on('peridot.end', function() use ($analyzer) {
        $analyzer->stop();
    });

};
