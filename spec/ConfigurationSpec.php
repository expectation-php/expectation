<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use expectation\Configuration;
use Assert\Assertion;
use Prophecy\Prophet;

describe('Configuration', function() {

    describe('__construct', function() {
        beforeEach(function() {
            $this->prophet = new Prophet();

            $this->resolver = $this->prophet->prophesize('expectation\matcher\method\MethodResolverInterface');
            $this->resolver->find()->shouldNotBeCalled();
            $this->methodResolver = $this->resolver->reveal();

            $this->configuration = new Configuration([
                'methodResolver' => $this->methodResolver
            ]);
        });
        afterEach(function() {
            $this->prophet->checkPredictions();
        });
        it('should assign methodResolver property', function() {
            Assertion::isInstanceOf($this->configuration->getMethodResolver(), $this->methodResolver);
        });
    });

});
