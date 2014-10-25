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
use expectation\ConfigurationBuilder;
use \stdClass;

describe('Configurable', function() {

    describe('configure', function() {
        context('when with configurator', function() {

            $subject = new stdClass();
            $subject->callCount = 0;

            FixtureExpectation::configure(function(ConfigurationBuilder $config) use($subject) {
                $subject->callCount++;
                $config->registerMatcherNamespace('expectation\spec\fixture\matcher\basic', __DIR__ . '/fixture/matcher/basic');
            });
            it('should configurator call once', function() use($subject) {
                Assertion::same($subject->callCount, 1);
            });
            it('should create configuration', function() {
                Assertion::isInstanceOf(FixtureExpectation::configration(), 'expectation\Configuration');
            });
        });
        context('when configurator empty', function() {
            beforeEach(function() {
                FixtureExpectation::configure();
            });
            it('should create configuration', function() {
                Assertion::isInstanceOf(FixtureExpectation::configration(), 'expectation\Configuration');
            });
        });
    });

});
