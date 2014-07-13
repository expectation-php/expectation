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
use expectation\Expectation;
use expectation\ConfigurationBuilder;
use expectation\spec\fixture\FixtureTestCase;

describe('DSL', function() {

    describe('expect', function() {
        before(function() {
            Expectation::configure(function(ConfigurationBuilder $config) {
                $config->registerMatcherNamespace(
                    'expectation\spec\fixture\matcher\basic',
                    __DIR__ . '/fixture/matcher/basic'
                );
            });
            $this->testCase = new FixtureTestCase();
        });
        it('should lookup matcher method', function() {
            $result = $this->testCase->expect(true)->equals(true);
            Assertion::true($result);
        });
    });

});
