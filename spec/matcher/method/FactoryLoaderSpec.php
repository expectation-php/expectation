<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Assert\Assertion;
use \ReflectionClass;
use expectation\matcher\method\FactoryLoader;
use Doctrine\Common\Annotations\AnnotationReader;

describe('FactoryLoader', function() {

    beforeEach(function () {
        $this->className = '\expectation\spec\fixture\matcher\single\FixtureSingleMatcher';
    });

    describe('loadFromClass', function() {
        beforeEach(function () {
            $loader = new FactoryLoader(new AnnotationReader());
            $this->result = $loader->loadFromClass(new ReflectionClass($this->className));
        });
        it('return \ArrayIterator instance', function() {
            Assertion::isInstanceOf($this->result, '\ArrayIterator');
        });
    });

});
