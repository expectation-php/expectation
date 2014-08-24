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

    before(function () {
        $this->className = '\expectation\spec\fixture\matcher\single\FixtureSingleMatcher';
    });

    describe('current', function() {
        before(function () {
            $this->loader = new FactoryLoader(new ReflectionClass($this->className), new AnnotationReader());
        });
        it('return expectation\matcher\method\MethodFactoryInterface instance', function() {
            Assertion::isInstanceOf($this->loader->current(), 'expectation\matcher\method\MethodFactoryInterface');
        });
    });

    describe('key', function() {
        before(function () {
            $this->loader = new FactoryLoader(new ReflectionClass($this->className), new AnnotationReader());
        });
        it('return lookup key', function() {
            Assertion::same($this->loader->key(), 'to_eql');
        });
    });

    describe('next', function() {
        before(function () {
            $this->loader = new FactoryLoader(new ReflectionClass($this->className), new AnnotationReader());
            $this->loader->next();
        });
        it('move next', function() {
            Assertion::false($this->loader->valid());
        });
    });

});
