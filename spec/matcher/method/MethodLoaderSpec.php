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
use Doctrine\Common\Annotations\AnnotationReader;
use expectation\matcher\method\MethodLoader;

describe('MethodLoader', function() {

    before(function() {
        $this->reader = new AnnotationReader();
    });

    describe('load', function() {
        before(function() {
            $this->loader = new MethodLoader($this->reader);
            $this->loader->registerNamespace('expectation\spec\fixture', __DIR__ . '/../../fixture');
            $this->container = $this->loader->load();
        });
        it('should return expectation\matcher\method\MethodContainerInterface instance', function() {
            Assertion::isInstanceOf($this->container, 'expectation\matcher\method\MethodContainerInterface');
        });
        it('should factory loaded', function() {
            $method = $this->container->find('toEqual', [true]);
            Assertion::same($method->expectValue, true);
            Assertion::isInstanceOf($method, 'expectation\matcher\MethodInterface');
        });
    });

});
