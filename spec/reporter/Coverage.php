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
use PHP_CodeCoverage;
use PHP_CodeCoverage_Report_Clover;

/**
 * @package expectation\spec\reporter
 */
class Coverage extends Spec
{

    private $coverage;

    public function before_all($results)
    {
        $this->coverage = new PHP_CodeCoverage;
        $this->coverage->filter()->addDirectoryToWhitelist('src');
        $this->coverage->start('default');

        parent::before_all($results);
    }

    public function after_all($results)
    {
        $this->coverage->stop();

        $directoryPath = getcwd();
        $writer = new PHP_CodeCoverage_Report_Clover;
        $writer->process($this->coverage, $directoryPath . '/clover.xml');
//var_dump($results);
        parent::after_all($results);
    }

}

