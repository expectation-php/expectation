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
use Prophecy\Prophet;
use expectation\matcher\method\MethodResolver;
use expectation\matcher\MatcherNotFoundException;

describe('MethodResolver', function() {

    describe('find', function() {
        context('when factory registered', function() {
            beforeEach(function() {
                $this->prophet = new Prophet();
                $this->reflectionMethod = new ReflectionMethod('\\expectation\\spec\\fixture\\matcher\\basic\\FixtureMatcher', 'match');

                $this->registry = $this->prophet->prophesize('expectation\matcher\reflection\ReflectionRegistryInterface');
                $this->registry->get()->withArguments(['toEquals'])
                    ->willReturn($this->reflectionMethod)->shouldBeCalled();

                $this->resolver = new MethodResolver($this->registry->reveal());

                $this->findResult = $this->resolver->find('toEquals', [true]);
            });
            it('find the container', function() {
                $this->prophet->checkPredictions();
            });
            it('return expectation\matcher\MethodInterface', function() {
                Assertion::isInstanceOf($this->findResult, 'expectation\matcher\MethodInterface');
            });
        });
        context('when factory not registered', function() {
            beforeEach(function() {
                $this->prophet = new Prophet();
                $this->reflectionMethod = new ReflectionMethod('\\expectation\\spec\\fixture\\matcher\\basic\\FixtureMatcher', 'match');

                $this->registry = $this->prophet->prophesize('expectation\matcher\reflection\ReflectionRegistryInterface');
                $this->registry->get()->withArguments(['toEquals'])
                    ->willThrow('expectation\matcher\reflection\ReflectionNotFoundException');

                $this->resolver = new MethodResolver($this->registry->reveal());

                $this->throwException = null;

                try {
                    $this->resolver->find('toEquals', [true]);
                } catch (MatcherNotFoundException $exception) {
                    $this->throwException = $exception;
                }
            });
            it('find the container', function() {
                $this->prophet->checkPredictions();
            });
            it('throw expectation\matcher\MatcherNotFoundException', function() {
                Assertion::isInstanceOf($this->throwException, 'expectation\matcher\MatcherNotFoundException');
            });
        });
    });

});
