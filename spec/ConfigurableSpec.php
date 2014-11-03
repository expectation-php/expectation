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
use expectation\spec\fixture\FixtureExpectation;

describe('Configurable', function() {
    describe('configure', function() {
        beforeEach(function() {
            FixtureExpectation::configure();
        });
        it('should create configuration', function() {
            Assertion::isInstanceOf(FixtureExpectation::configration(), 'expectation\Configuration');
        });
    });
    describe('configureWithFile', function() {
        beforeEach(function() {
            $configPath = __DIR__ . '/fixture/config/config.php';
            FixtureExpectation::configureWithFile($configPath);
        });
        it('create configuration', function() {
            Assertion::isInstanceOf(FixtureExpectation::configration(), 'expectation\Configuration');
        });
    });
});
