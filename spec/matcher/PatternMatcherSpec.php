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
use expectation\matcher\PatternMatcher;

describe('PatternMatcher', function() {

    before_each(function() {
        $this->matcher = new PatternMatcher(new Formatter());
        $this->matcher->expectValue = '/foo/';
    });

    describe('match', function() {
        context('when match pattern', function() {
            it('should return true', function() {
                Assertion::true($this->matcher->match('foobar'));
            });
        });
        context('when not match pattern', function() {
            it('should return false', function() {
                Assertion::false($this->matcher->match('barbar'));
            });
        });
    });

    describe('getFailureMessage', function() {
        it('should return the message on failure', function() {
            Assertion::false($this->matcher->match('barbar'));
            Assertion::same($this->matcher->getFailureMessage(), "Expected 'barbar' to match '/foo/'");
        });
    });

    describe('getNegatedFailureMessage', function() {
        it('should return the message on failure', function() {
            Assertion::false($this->matcher->match('barbar'));
            Assertion::same($this->matcher->getNegatedFailureMessage(), "Expected 'barbar' not to match '/foo/'");
        });
    });

});
