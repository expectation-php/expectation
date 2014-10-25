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

            $this->container = $this->prophet->prophesize('expectation\matcher\method\MethodContainerInterface');
            $this->container->find()->shouldNotBeCalled();
            $this->methodContainer = $this->container->reveal();

            $this->configuration = new Configuration([
                'methodContainer' => $this->methodContainer
            ]);
        });
        afterEach(function() {
            $this->prophet->checkPredictions();
        });
        it('should assign methodContainer property', function() {
            Assertion::isInstanceOf($this->configuration->methodContainer, $this->methodContainer);
        });
    });

});
