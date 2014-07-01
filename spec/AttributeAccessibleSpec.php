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
use expectation\BadPropertyAccessException;
use expectation\spec\fixture\FixtureObject;

describe('AttributeAccessible', function() {

    before_each(function() {
        $this->object = new FixtureObject();
        $this->throwException = false;
    });

    describe('accessors', function() {
        it('should assign value', function() {
            $this->object->name = 'foo';
            Assertion::same($this->object->name, 'foo');
        });
        context('when not extist readable property access', function() {
            it('should throw BadPropertyAccessException exception', function() {
                try {
                    $value = $this->object->not_found;
                } catch (BadPropertyAccessException $exception) {
                    $this->throwException = $exception;
                }
                Assertion::isInstanceOf($this->throwException, '\expectation\BadPropertyAccessException');
            });
        });
        context('when not extist writable property access', function() {
            it('should throw BadMethodCallException exception', function() {
                try {
                    $this->object->not_found = 'foo';
                } catch (BadPropertyAccessException $exception) {
                    $this->throwException = $exception;
                }
                Assertion::isInstanceOf($this->throwException, '\expectation\BadPropertyAccessException');
            });
        });
    });

});
