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
use expectation\matcher\Formatter;
use expectation\matcher\MaximumMatcher;

describe('MaximumMatcher', function() {

    beforeEach(function() {
        $this->matcher = new MaximumMatcher(new Formatter());
    });

    describe('match', function() {
        context('when less than', function() {
            it('should return true', function() {
                $this->matcher->expectValue = 2;
                Assertion::true($this->matcher->match(1));
            });
        });
        context('when not less than', function() {
            it('should return false', function() {
                $this->matcher->expectValue = 1;
                Assertion::false($this->matcher->match(2));
            });
        });
    });

    describe('getFailureMessage', function() {
        it('should return the message on failure', function() {
            $this->matcher->expectValue = 2;
            Assertion::false($this->matcher->match(3));
            Assertion::same($this->matcher->getFailureMessage(), "Expected 3 to be less than 2");
        });
    });

    describe('getNegatedFailureMessage', function() {
        it('should return the message on failure', function() {
            $this->matcher->expectValue = 3;
            Assertion::true($this->matcher->match(2));
            Assertion::same($this->matcher->getNegatedFailureMessage(), "Expected 2 not to be less than 3");
        });
    });

});
