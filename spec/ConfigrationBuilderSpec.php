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
use expectation\ConfigrationBuilder;

describe('ConfigrationBuilder', function() {

    describe('registerMatcherNamespace', function() {
        before(function() {
            $this->builder = new ConfigrationBuilder();
            $this->builder->registerMatcherNamespace('expectation\matcher', __DIR__ . '/../src/matcher');
        });
        it('should return namespace', function() {
            Assertion::same($this->builder->matcherNamespaces[0]['namespace'], 'expectation\matcher');
        });
    });

    describe('build', function() {
        before(function() {
            $this->builder = new ConfigrationBuilder();
            $this->builder->registerMatcherNamespace('expectation\matcher', __DIR__ . '/../src/matcher');
            $this->configration = $this->builder->build();
        });
        it('should return expectation\MatcherMethodContainer instance', function() {
            Assertion::isInstanceOf($this->configration->methodContainer, 'expectation\MatcherMethodContainer');
        });
    });

});
