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
use expectation\matcher\SuffixMatcher;

describe('SuffixMatcher', function() {

    before_each(function() {
        $this->matcher = new SuffixMatcher(new Formatter());
        $this->matcher->expectValue = 'foo';
    });

    describe('match', function() {
        context('when match suffix', function() {
            it('should return true', function() {
                Assertion::true($this->matcher->match('barfoo'));
            });
        });
        context('when not match suffix', function() {
            it('should return false', function() {
                Assertion::false($this->matcher->match('foobar'));
            });
        });
    });

    describe('getFailureMessage', function() {
        it('should return the message on failure', function() {
            Assertion::false($this->matcher->match('foobar'));
            Assertion::same($this->matcher->getFailureMessage(), "Expected 'foobar' to end with 'foo'");
        });
    });

    describe('getNegatedFailureMessage', function() {
        it('should return the message on failure', function() {
            Assertion::true($this->matcher->match('barfoo'));
            Assertion::same($this->matcher->getNegatedFailureMessage(), "Expected 'barfoo' not to end with 'foo'");
        });
    });

});
