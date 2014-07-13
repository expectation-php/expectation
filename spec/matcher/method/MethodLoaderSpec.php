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
use Doctrine\Common\Annotations\AnnotationReader;
use expectation\matcher\method\MethodLoader;
use expectation\matcher\method\AlreadyRegisteredException;
use ReflectionClass;

describe('MethodLoader', function() {

    before_each(function() {
        $this->reader = new AnnotationReader();
        $this->loader = new MethodLoader($this->reader);
        $this->loader->registerNamespace('expectation\spec\fixture\matcher\basic', __DIR__ . '/../../fixture/matcher/basic');

        $this->reflectionClass = new ReflectionClass('expectation\spec\fixture\matcher\single\FixtureSingleMatcher');
        $this->loader->registerClass($this->reflectionClass);
    });

    describe('load', function() {
        context('when matcher is not duplicated', function() {
            before_each(function() {
                $this->container = $this->loader->load();
            });
            it('should return expectation\matcher\method\MethodContainerInterface instance', function() {
                Assertion::isInstanceOf($this->container, 'expectation\matcher\method\MethodContainerInterface');
            });
            it('should factory loaded', function() {
                $method = $this->container->find('toEquals', [true]);
                Assertion::same($method->expectValue, true);
                Assertion::isInstanceOf($method, 'expectation\matcher\MethodInterface');
            });
        });
        context('when matcher is duplicated', function() {
            before_each(function() {
                $this->loader->registerNamespace('expectation\spec\fixture\matcher\duplicated', __DIR__ . '/../../fixture/matcher/duplicated/');
            });
            it('should throw expectation\matcher\method\AlreadyRegisteredException', function() {
                $throwException = null;
                try {
                    $this->loader->load();
                } catch (AlreadyRegisteredException $exception) {
                    $throwException = $exception;
                }
                Assertion::isInstanceOf($throwException, 'expectation\matcher\method\AlreadyRegisteredException');
            });
        });
    });

});
