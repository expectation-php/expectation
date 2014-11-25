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
            $this->matcherMethod = $this->prophet->prophesize('expectation\matcher\MethodInterface');
        });

        /**
         * expect($value)->toEqual(true)
         */
        context('when normal evaluation', function() {
            beforeEach(function() {
                $this->matcherMethod->positiveMatch()
                    ->withArguments([true])
                    ->shouldBeCalled();

                $this->resolver = $this->prophet->prophesize('expectation\matcher\method\MethodResolverInterface');
                $this->resolver->find()->withArguments(['toEqual', [true]])
                    ->willReturn($this->matcherMethod->reveal())
                    ->shouldBeCalled();

                $this->evaluator = new Evaluator($this->resolver->reveal());
                $this->evaluator->that(true);
            });
            context('when match the conditions', function() {
                it('do not do anything', function() {
                    $this->evaluator->toEqual(true);
                    $this->prophet->checkPredictions();
                });
            });
        });

        /**
         * expect($value)->not()->toEqual(true)
         */
        context('when negative evaluation', function() {
            beforeEach(function() {
                $this->matcherMethod->negativeMatch()
                    ->withArguments([false])
                    ->shouldBeCalled();

                $this->resolver = $this->prophet->prophesize('expectation\matcher\method\MethodResolverInterface');
                $this->resolver->find()->withArguments(['toEqual', [true]])
                    ->willReturn($this->matcherMethod->reveal())
                    ->shouldBeCalled();

                $this->evaluator = new Evaluator($this->resolver->reveal());
                $this->evaluator->that(false)->not();
            });
            context('when match the conditions', function() {
                it('do not do anything', function() {
                    $this->evaluator->toEqual(true);
                    $this->prophet->checkPredictions();
                });
            });
        });
    });

});
