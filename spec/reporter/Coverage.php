<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expectation\spec\reporter;

use Preview\Reporter\Spec;
use cloak\Analyzer;
use cloak\ConfigurationBuilder;
use cloak\result\File;
use cloak\reporter\CompositeReporter;
use cloak\reporter\LcovReporter;
use cloak\reporter\MarkdownReporter;
use cloak\reporter\TextReporter;
use cloak\reporter\ProcessingTimeReporter;

/**
 * @package expectation\spec\reporter
 */
class Coverage extends Spec
{

    private $analyzer;

    public function before_all($results)
    {
        $this->analyzer = Analyzer::factory(function(ConfigurationBuilder $builder) {
            $reporter = new CompositeReporter([
                new LcovReporter(__DIR__ . '/../../report.lcov'),
                new MarkdownReporter(__DIR__ . '/../../report.md'),
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
        $this->analyzer->start();

        parent::before_all($results);
    }

    public function after_all($results)
    {
        $this->analyzer->stop();
        parent::after_all($results);
    }

}
