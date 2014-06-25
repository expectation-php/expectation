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

describe('ConfigrationTrait', function() {

    describe('configure', function() {
        before(function() {
            FixtureExpectation::configure(function(ConfigrationBuilder $config) {
                $config->registerMatcherNamespace('expectation\spec\fixture', __DIR__ . '/fixture');
            });
        });
        it('should create configration', function() {
            Assertion::isInstanceOf(FixtureExpectation::configration(), 'expectation\Configration');
        });
    });

});
