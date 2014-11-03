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
use Doctrine\Common\Annotations\AnnotationReader;
use expectation\matcher\method\MethodLoader;
use expectation\matcher\reflection\AlreadyRegisteredException;



describe('MethodLoader', function() {

    beforeEach(function() {
        $this->reader = new AnnotationReader();
        $this->loader = new MethodLoader($this->reader);
    });

    describe('load', function() {
        context('when matcher is not duplicated', function() {
            context('when namespace', function() {
                beforeEach(function() {
                    $this->loader->registerNamespace('expectation\spec\fixture\matcher\basic', __DIR__ . '/../../fixture/matcher/basic');
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
        });
        context('when matcher is duplicated', function() {
            beforeEach(function() {
                $this->loader->registerNamespace('expectation\spec\fixture\matcher\basic', __DIR__ . '/../../fixture/matcher/basic');
                $this->loader->registerNamespace('expectation\spec\fixture\matcher\duplicated', __DIR__ . '/../../fixture/matcher/duplicated/');
            });
            it('should throw expectation\matcher\reflection\AlreadyRegisteredException', function() {
                $throwException = null;
                try {
                    $this->loader->load();
                } catch (AlreadyRegisteredException $exception) {
                    $throwException = $exception;
                }
                Assertion::isInstanceOf($throwException, 'expectation\matcher\reflection\AlreadyRegisteredException');
            });
        });
    });

});
