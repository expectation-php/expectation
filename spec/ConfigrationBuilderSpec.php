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
            $this->builder->registerMatcherNamespace('expectation\spec\fixture', __DIR__ . '/fixture');
        });
        it('should return namespace', function() {
            $matcherNamespaces = $this->builder->matcherNamespaces();
            Assertion::same($matcherNamespaces['expectation\spec\fixture'], __DIR__ . '/fixture');
        });
    });

    describe('build', function() {
        before(function() {
            $this->builder = new ConfigrationBuilder();
            $this->builder->registerMatcherNamespace('expectation\spec\fixture', __DIR__ . '/fixture');
            $this->configration = $this->builder->build();
        });
        it('should return expectation\matcher\method\MethodContainer instance', function() {
            Assertion::isInstanceOf($this->configration->methodContainer, 'expectation\matcher\method\MethodContainer');
        });
    });

});
