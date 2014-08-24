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
use ReflectionClass;
use expectation\matcher\method\FactoryLoader;
use Doctrine\Common\Annotations\AnnotationReader;

describe('FactoryLoader', function() {

    describe('current', function() {
        before(function () {
            $className = '\expectation\spec\fixture\matcher\single\FixtureSingleMatcher';
            $loader = new FactoryLoader(new ReflectionClass($className), new AnnotationReader());
            $this->factory = $loader->current();
        });
        it('return expectation\matcher\method\MethodFactoryInterface instance', function() {
            Assertion::isInstanceOf($this->factory, 'expectation\matcher\method\MethodFactoryInterface');
        });
    });

});
