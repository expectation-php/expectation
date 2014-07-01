<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Preview\DSL\BDD;

use Assert\Assertion;
use expectation\spec\fixture\FixtureExpectation;
use expectation\ConfigrationBuilder;
use stdClass;

describe('Configurable', function() {

    describe('configure', function() {
        context('when with configurator', function() {
            before(function() {
                $this->subject = $subject = new stdClass();
                $this->subject->callCount = 0;
                $this->subject->callArgument = null;

                FixtureExpectation::configure(function(ConfigrationBuilder $config) use($subject) {
                    $subject->callCount++;
                    $subject->callArgument = $config;

                    $config->registerMatcherNamespace('expectation\spec\fixture', __DIR__ . '/fixture');
                });
            });
            it('should create configration', function() {
                Assertion::isInstanceOf(FixtureExpectation::configration(), 'expectation\Configration');
            });
/*
            it('should configurator call once', function() {
                Assertion::same($this->subject->callCount, 1);
            });
*/
        });
        context('when configurator empty', function() {
            before(function() {
                FixtureExpectation::configure();
            });
            it('should create configration', function() {
                Assertion::isInstanceOf(FixtureExpectation::configration(), 'expectation\Configration');
            });
        });
    });

});
