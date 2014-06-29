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
use expectation\spec\fixture\FixtureObject;

describe('AttributeAccessible', function() {

    describe('accessors', function() {
        it('should assign value', function() {
            $object = new FixtureObject();
            $object->name = 'foo';
            Assertion::same($object->name, 'foo');
        });
    });

});
