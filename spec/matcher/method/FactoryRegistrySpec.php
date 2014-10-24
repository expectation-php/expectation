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
use ReflectionMethod;
use expectation\matcher\method\FactoryRegistry;
use expectation\matcher\method\AlreadyRegisteredException;

describe('FactoryRegistry', function() {

    describe('register', function() {
        context('when empty', function() {
            beforeEach(function() {
                $this->prophet = new Prophet();

                $factory = $this->prophet->prophesize('\expectation\matcher\method\MethodFactoryInterface');
                $factory->withArguments()->shouldNotBeCalled();

                $this->factory = $factory->reveal();

                $this->registry = new FactoryRegistry();
                $this->registry->register('factory', $this->factory);
            });
            afterEach(function() {
                $this->prophet->checkPredictions();
            });
            it('register factory', function() {
                Assertion::same($this->registry->get('factory'), $this->factory);
            });
        });
        context('when factory is duplicated', function() {
            beforeEach(function() {
                $this->prophet = new Prophet();

                $factory = $this->prophet->prophesize('\expectation\matcher\method\MethodFactoryInterface');
                $factory->withArguments()->shouldNotBeCalled();
                $factory->getMethod()->willReturn(new ReflectionMethod('\expectation\matcher\method\FactoryRegistry', 'get'));

                $this->factory = $factory->reveal();

                $this->registry = new FactoryRegistry();
                $this->registry->register('factory', $this->factory);
            });
            afterEach(function() {
                $this->prophet->checkPredictions();
            });
            it('throw expectation\matcher\method\AlreadyRegisteredException', function() {
                $throwException = null;
                try {
                    $this->registry->register('factory', $this->factory);
                } catch (AlreadyRegisteredException $exception) {
                    $throwException = $exception;
                }
                Assertion::isInstanceOf($throwException, '\expectation\matcher\method\AlreadyRegisteredException');
            });
        });
    });

});
