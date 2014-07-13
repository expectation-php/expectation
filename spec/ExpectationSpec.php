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

describe('Expectation', function() {

    describe('expect', function() {
        before(function() {
            Expectation::configure(function(ConfigurationBuilder $config) {
                $config->registerMatcherNamespace('expectation\spec\fixture\matcher\basic', __DIR__ . '/fixture/matcher/basic');
            });
        });
        it('should lookup matcher method', function() {
            Expectation::expect(true)->equals(true);
        });
    });

});
