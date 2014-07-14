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
use expectation\matcher\Formatter;
use expectation\matcher\RangeMatcher;

describe('RangeMatcher', function() {

    before_each(function() {
        $this->matcher = new RangeMatcher(new Formatter());
        $this->matcher->expectValue = [0, 100];
    });

    describe('match', function() {
        context('when match suffix', function() {
            it('should return true', function() {
                Assertion::true($this->matcher->match(0));
            });
        });
        context('when not match suffix', function() {
            it('should return false', function() {
                Assertion::false($this->matcher->match(101));
            });
        });
    });

    describe('getFailureMessage', function() {
        it('should return the message on failure', function() {
            Assertion::false($this->matcher->match(101));
            Assertion::same($this->matcher->getFailureMessage(), "Expected 101 to be within 0 between 100");
        });
    });

    describe('getNegatedFailureMessage', function() {
        it('should return the message on failure', function() {
            Assertion::true($this->matcher->match(0));
            Assertion::same($this->matcher->getNegatedFailureMessage(), "Expected 0 not to be within 0 between 100");
        });
    });

});
