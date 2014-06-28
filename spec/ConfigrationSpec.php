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

use expectation\Configration;
use Assert\Assertion;
use Prophecy\Prophet;

describe('Configration', function() {

    describe('__construct', function() {
        before(function() {
            $this->prophet = new Prophet();

            $this->container = $this->prophet->prophesize('expectation\matcher\method\MethodContainerInterface');
            $this->container->find()->shouldNotBeCalled();
            $this->methodContainer = $this->container->reveal();

            $this->configration = new Configration([
                'methodContainer' => $this->methodContainer
            ]);
        });
        after(function() {
            $this->prophet->checkPredictions();
        });
        it('should assign methodContainer property', function() {
            Assertion::isInstanceOf($this->configration->methodContainer, $this->methodContainer);
        });
    });

});
