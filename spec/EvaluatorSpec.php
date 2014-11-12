<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use expectation\Evaluator;
use Prophecy\Prophet;

describe('Evaluator', function() {

    describe('__call', function() {
        beforeEach(function() {
            $this->prophet = new Prophet();

            $this->matcher = $this->prophet->prophesize('expectation\matcher\MethodInterface');
            $this->matcher->setExpectValue()->withArguments([true]);
            $this->matcher->positiveMatch()->withArguments([true]);

            $this->resolver = $this->prophet->prophesize('expectation\matcher\method\MethodResolverInterface');
            $this->resolver->find()->withArguments(['toEqual', [true]])
                ->willReturn($this->matcher->reveal());

            $this->evaluator = new Evaluator($this->resolver->reveal());
        });

        afterEach(function() {
            $this->prophet->checkPredictions();
        });

        it('should lookup matcher method', function() {
            $this->evaluator->toEqual(true);
        });
    });

});
