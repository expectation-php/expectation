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
use expectation\ConfigurationBuilder;
use expectation\MatcherNotFoundException;

describe('ConfigurationBuilder', function() {

    describe('registerMatcherNamespace', function() {
        before(function() {
            $this->builder = new ConfigurationBuilder();
            $this->builder->registerMatcherNamespace('expectation\spec\fixture\matcher\basic', __DIR__ . '/fixture/matcher/basic');
        });
        it('should register matcher namespace', function() {
            $matcherNamespaces = $this->builder->getMatcherNamespaces();
            $directory = $matcherNamespaces->get('expectation\spec\fixture\matcher\basic');

            Assertion::same($directory->get(), __DIR__ . '/fixture/matcher/basic');
        });
    });

    describe('registerMatcherClass', function() {
        before(function() {
            $this->builder = new ConfigurationBuilder();
        });
        context('when class exist', function() {
            before(function() {
                $this->builder->registerMatcherClass('expectation\spec\fixture\matcher\basic\FixtureMatcher');
            });
            it('should register matcher classes', function() {
                $matcherClasses = $this->builder->getMatcherClasses();
                $refClass = $matcherClasses->get('expectation\spec\fixture\matcher\basic\FixtureMatcher');

                Assertion::same($refClass->get()->getName(), 'expectation\spec\fixture\matcher\basic\FixtureMatcher');
            });
        });
        context('when class not found', function() {
            it('should throw expectation\MatcherNotFoundException exception', function() {
                $throwException = null;

                try {
                    $this->builder->registerMatcherClass('expectation\spec\FixtureMatcher');
                } catch (MatcherNotFoundException $exception) {
                    $throwException = $exception;
                }
                Assertion::isInstanceOf($throwException, 'expectation\MatcherNotFoundException');
            });
        });
    });

    describe('build', function() {
        before(function() {
            $this->builder = new ConfigurationBuilder();
            $this->builder->registerMatcherNamespace('expectation\spec\fixture\matcher\basic', __DIR__ . '/fixture/matcher/basic');
            $this->configration = $this->builder->build();
        });
        it('should return expectation\matcher\method\MethodContainer instance', function() {
            Assertion::isInstanceOf($this->configration->methodContainer, 'expectation\matcher\method\MethodContainer');
        });
    });

});
