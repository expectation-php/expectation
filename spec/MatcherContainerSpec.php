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
use expectation\MatcherContainer;
use Prophecy\Prophet;
use ArrayObject;

describe('MatcherContainer', function() {

    before(function() {
        $this->prophet = new Prophet();

        $this->matcher = $this->prophet->prophesize('expectation\MatcherInterface');
        $this->matcher->expected()->withArguments([true]);

        $this->factory = $this->prophet->prophesize('expectation\MatcherFactoryInterface');
        $this->factory->withArguments()
            ->withArguments([[true]])
            ->willReturn($this->matcher->reveal());

        $this->values = new ArrayObject([
            'toEqual' => $this->factory->reveal()
        ]);
        $this->container = new MatcherContainer($this->values);
    });

    after(function() {
        $this->prophet->checkPredictions();
    });

    it('should return expectation\MatcherInterface', function() {
        $factory = $this->container->find('toEqual', [true]);
        Assertion::isInstanceOf($factory, 'expectation\MatcherInterface');
    });

});
