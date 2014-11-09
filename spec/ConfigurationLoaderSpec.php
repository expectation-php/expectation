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
use expectation\configuration\ConfigurationFileNotFoundException;


describe('ConfigurationLoader', function() {
    beforeEach(function() {
        $this->loader = new ConfigurationLoader();
    });

/*
    describe('#load', function() {
        context('when file exists', function() {
            beforeEach(function() {
                $configPath = __DIR__ . '/fixture/config/config.php';
                $this->config = $this->loader->load($configPath);
            });
            it('return expectation\Configuration instance', function() {
                Assertion::isInstanceOf($this->config, 'expectation\Configuration');
            });
        });
        context('when file not exists', function() {
            beforeEach(function() {
                try {
                    $this->thrownExceptiion = false;
                    $this->loader->load('font_found_config.php');
                } catch(ConfigurationFileNotFoundException $e) {
                    $this->thrownExceptiion = true;
                }
            });
            it('throw ConfigurationFileNotFoundException', function() {
                Assertion::true($this->thrownExceptiion);
            });
        });
    });
*/
    describe('#loadFromComposerJson', function() {
        beforeEach(function() {
            $configPath = __DIR__ . '/fixture/config/composer.json';
            $this->config = $this->loader->loadFromComposerJson($configPath);
        });
        it('return expectation\Configuration instance', function() {
            Assertion::isInstanceOf($this->config, 'expectation\Configuration');
        });
    });

});
