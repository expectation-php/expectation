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
use Prophecy\Prophet;
use expectation\matcher\method\MethodContainer;

describe('MethodContainer', function() {

    describe('find', function() {
        context('when factory registered', function() {
            before(function() {
                $this->prophet = new Prophet();

                $this->method = $this->prophet->prophesize('expectation\matcher\MethodInterface');
                $this->method->setExpectValue()->withArguments([true]);

                $this->factory = $this->prophet->prophesize('expectation\matcher\method\MethodFactoryInterface');
                $this->factory->withArguments()
                    ->withArguments([[true]])
                    ->willReturn($this->method->reveal());

                $this->registry = $this->prophet->prophesize('expectation\matcher\method\FactoryRegistryInterface');
                $this->registry->get()->withArguments(['toEqual'])->willReturn($this->factory->reveal());

                $this->container = new MethodContainer($this->registry->reveal());
            });
            after(function() {
                $this->prophet->checkPredictions();
            });
            it('return expectation\matcher\MethodInterface', function() {
                $factory = $this->container->find('toEqual', [true]);
                Assertion::isInstanceOf($factory, 'expectation\matcher\MethodInterface');
            });
        });
    });

});
