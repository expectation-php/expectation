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
use expectation\matcher\method\FactoryRegistry;

describe('FactoryRegistry', function() {

    describe('register', function() {
        before(function() {
            $this->prophet = new Prophet();

            $factory = $this->prophet->prophesize('\expectation\matcher\method\MethodFactoryInterface');
            $factory->withArguments()->shouldNotBeCalled();

            $this->factory = $factory->reveal();

            $this->registry = new FactoryRegistry();
            $this->registry->register('factory', $this->factory);
        });
        after(function() {
            $this->prophet->checkPredictions();
        });
        it('register factory', function() {
            Assertion::same($this->registry->get('factory'), $this->factory);
        });
    });

});
