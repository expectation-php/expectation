<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Assert\Assertion;
use expectation\ConfigurationLoader;

describe('ConfigurationLoader', function() {
    beforeEach(function() {
        $this->loader = new ConfigurationLoader();
    });
    describe('#load', function() {
        beforeEach(function() {
            $configPath = __DIR__ . '/fixture/config/config.php';
            $this->config = $this->loader->load($configPath);
        });
        it('return expectation\Configuration instance', function() {
            Assertion::isInstanceOf($this->config, 'expectation\Configuration');
        });
    });
});
