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
use expectation\Expectation;
use Prophecy\Prophet;

describe('Expectation', function() {

    describe('__call', function() {
        before(function() {
            $this->prophet = new Prophet();

            $this->matcher = $this->prophet->prophesize('expectation\matcher\MatcherMethodInterface');
            $this->matcher->expected()->withArguments([true]);
            $this->matcher->positiveMatch()->withArguments([true]);

            $this->container = $this->prophet->prophesize('expectation\MatcherMethodContainerInterface');
            $this->container->find()->withArguments(['toEqual', [true]])
                ->willReturn($this->matcher->reveal());

            $this->expectation = new Expectation($this->container->reveal());
        });
        after(function() {
            $this->prophet->checkPredictions();
        });

        it('should lookup matcher method', function() {
            $this->expectation->toEqual(true);
        });
    });

});
