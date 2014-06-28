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
use expectation\matcher\method\MethodContainer;
use expectation\matcher\method\FactoryNotFoundException;
use Prophecy\Prophet;

describe('MethodContainer', function() {

    describe('find', function() {
        before(function() {
            $this->prophet = new Prophet();

            $this->method = $this->prophet->prophesize('expectation\matcher\MethodInterface');
            $this->method->expected()->withArguments([true]);

            $this->factory = $this->prophet->prophesize('expectation\matcher\method\MethodFactoryInterface');
            $this->factory->withArguments()
                ->withArguments([[true]])
                ->willReturn($this->method->reveal());

            $this->values = [
                'toEqual' => $this->factory->reveal()
            ];
            $this->container = new MethodContainer($this->values);
        });

        after(function() {
            $this->prophet->checkPredictions();
        });

        context('when factory registered', function() {
            it('should return expectation\matcher\MethodInterface', function() {
                $factory = $this->container->find('toEqual', [true]);
                Assertion::isInstanceOf($factory, 'expectation\matcher\MethodInterface');
            });
        });
        context('when factory not registered', function() {
            it('should return expectation\matcher\method\FactoryNotFoundException', function() {
                $throwException = null;

                try {
                    $this->container->find('toBeNull', []);
                } catch (FactoryNotFoundException $exception) {
                    $throwException = $exception;
                }
                Assertion::isInstanceOf($throwException, 'expectation\matcher\method\FactoryNotFoundException');
            });
        });
    });

});
