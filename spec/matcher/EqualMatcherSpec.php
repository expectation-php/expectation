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
use expectation\matcher\EqualMatcher;

describe('EqualMatcher', function() {

    describe('match', function() {
        before_each(function() {
            $this->matcher = new EqualMatcher();
        });
        context('when same value', function() {
            it('should return true', function() {
                $result = $this->matcher->expected(true)->match(true);
                Assertion::true($result);
            });
        });
        context('when not same value', function() {
            it('should return false', function() {
                $result = $this->matcher->expected(false)->match(true);
                Assertion::false($result);
            });
        });
    });

});
