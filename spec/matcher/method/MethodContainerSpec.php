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
use PhpOption\Some;

describe('MethodContainer', function() {

    before_each(function() {
        $this->prophet = new Prophet();

        $this->factories = $this->prophet->prophesize('PhpCollection\MapInterface');
        $this->factories->first()->shouldNotBeCalled();
        $this->factories->last()->shouldNotBeCalled();
        $this->factories->find()->shouldNotBeCalled();
        $this->factories->set()->shouldNotBeCalled();
        $this->factories->remove()->shouldNotBeCalled();
        $this->factories->addMap()->shouldNotBeCalled();
        $this->factories->keys()->shouldNotBeCalled();
        $this->factories->values()->shouldNotBeCalled();
        $this->factories->drop()->shouldNotBeCalled();
        $this->factories->dropRight()->shouldNotBeCalled();
        $this->factories->dropWhile()->shouldNotBeCalled();
        $this->factories->take()->shouldNotBeCalled();
        $this->factories->takeWhile()->shouldNotBeCalled();
    });

    describe('find', function() {
        context('when factory registered', function() {
            before_each(function() {
                $this->method = $this->prophet->prophesize('expectation\matcher\MethodInterface');
                $this->method->setExpectValue()->withArguments([true]);

                $this->factory = $this->prophet->prophesize('expectation\matcher\method\MethodFactoryInterface');
                $this->factory->withArguments()
                    ->withArguments([[true]])
                    ->willReturn($this->method->reveal());

                $this->someValue = new Some($this->factory->reveal());

                $this->factories->containsKey()->withArguments(['toEqual'])->willReturn(true);
                $this->factories->get()->withArguments(['toEqual'])->willReturn($this->someValue);

                $this->container = new MethodContainer($this->factories->reveal());
            });

            after_each(function() {
                $this->prophet->checkPredictions();
            });

            it('should return expectation\matcher\MethodInterface', function() {
                $factory = $this->container->find('toEqual', [true]);
                Assertion::isInstanceOf($factory, 'expectation\matcher\MethodInterface');
            });
        });

        context('when factory not registered', function() {

            before_each(function() {
                $this->factories->get()->shouldNotBeCalled();
                $this->factories->containsKey()->withArguments(['toBeNull'])->willReturn(false);
                $this->container = new MethodContainer($this->factories->reveal());
            });

            after_each(function() {
                $this->prophet->checkPredictions();
            });

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
