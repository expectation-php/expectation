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
use expectation\MatcherMethodContainer;
use expectation\FactoryNotFoundException;
use Prophecy\Prophet;

describe('MatcherMethodContainer', function() {

    describe('find', function() {
        before(function() {
            $this->prophet = new Prophet();

            $this->method = $this->prophet->prophesize('expectation\matcher\MatcherMethodInterface');
            $this->method->expected()->withArguments([true]);

            $this->factory = $this->prophet->prophesize('expectation\MatcherMethodFactoryInterface');
            $this->factory->withArguments()
                ->withArguments([[true]])
                ->willReturn($this->method->reveal());

            $this->values = [
                'toEqual' => $this->factory->reveal()
            ];
            $this->container = new MatcherMethodContainer($this->values);
        });

        after(function() {
            $this->prophet->checkPredictions();
        });

        context('when factory registered', function() {
            it('should return expectation\matcher\MatcherMethodInterface', function() {
                $factory = $this->container->find('toEqual', [true]);
                Assertion::isInstanceOf($factory, 'expectation\matcher\MatcherMethodInterface');
            });
        });
        context('when factory not registered', function() {
            it('should return expectation\FactoryNotFoundException', function() {
                $throwException = null;

                try {
                    $this->container->find('toBeNull', []);
                } catch (FactoryNotFoundException $exception) {
                    $throwException = $exception;
                }
                Assertion::isInstanceOf($throwException, 'expectation\FactoryNotFoundException');
            });
        });
    });

});
