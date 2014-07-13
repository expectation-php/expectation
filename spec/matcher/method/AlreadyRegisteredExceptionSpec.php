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
use expectation\matcher\method\AlreadyRegisteredException;

describe('AlreadyRegisteredException', function() {

    describe('getMessage', function() {
        before(function() {
            $this->exception = new AlreadyRegisteredException("toEqual");
        });
        it('should return message' ,function() {
            Assertion::same($this->exception->getMessage(), "'toEqual' method of matcher is already registered");
        });
    });

});
