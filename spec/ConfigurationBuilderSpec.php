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
use expectation\ConfigurationBuilder;


describe('ConfigurationBuilder', function() {

    beforeEach(function() {
        $this->builder = new ConfigurationBuilder();
    });

    describe('registerMatcherNamespace', function() {
        beforeEach(function() {
            $this->builder->registerMatcherNamespace('expectation\spec\fixture\matcher\basic', __DIR__ . '/fixture/matcher/basic');
        });
        it('should register matcher namespace', function() {
            $matcherNamespaces = $this->builder->getMatcherNamespaces();
            $directory = $matcherNamespaces->get('expectation\spec\fixture\matcher\basic');

            Assertion::same($directory->get(), __DIR__ . '/fixture/matcher/basic');
        });
    });
    describe('build', function() {
        beforeEach(function() {
            $this->builder->registerMatcherNamespace('expectation\spec\fixture\matcher\basic', __DIR__ . '/fixture/matcher/basic');
            $this->configration = $this->builder->build();
        });
        describe('methodResolver', function() {
            it('return expectation\matcher\method\MethodResolver instance', function() {
                Assertion::isInstanceOf($this->configration->getMethodResolver(), 'expectation\matcher\method\MethodResolver');
            });
            it('matcher registered', function() {
                $methodResolver = $this->configration->getMethodResolver();
                Assertion::isInstanceOf($methodResolver->find('toEquals', [true]), 'expectation\matcher\MethodInterface');
            });
        });
    });

});
