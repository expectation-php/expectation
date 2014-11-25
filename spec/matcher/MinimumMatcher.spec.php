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
use expectation\matcher\MinimumMatcher;
use expectation\spec\helper\MatcherHelper;


describe('MinimumMatcher', function() {

    beforeEach(function() {
        $this->matcher = new MinimumMatcher(new Formatter());
        $this->matcherHelper = new MatcherHelper($this->matcher);
    });

    describe('match', function() {
        describe('annotations', function() {
            beforeEach(function() {
                $this->annotations = $this->matcherHelper->getAnnotations('match');
            });
            it('have toBeGreaterThan', function() {
                Assertion::keyExists($this->annotations, 'toBeGreaterThan');
            });
            it('have toBeAbove', function() {
                Assertion::keyExists($this->annotations, 'toBeAbove');
            });
        });

        context('when greater than', function() {
            it('should return true', function() {
                $this->matcher->setExpectValue(1);
                Assertion::true($this->matcher->match(2));
            });
        });
        context('when not greater than', function() {
            it('should return false', function() {
                $this->matcher->setExpectValue(2);
                Assertion::false($this->matcher->match(1));
            });
        });
    });

    describe('getFailureMessage', function() {
        it('should return the message on failure', function() {
            $this->matcher->setExpectValue(1);
            Assertion::false($this->matcher->match(0));
            Assertion::same($this->matcher->getFailureMessage(), "Expected 0 to be greater than 1");
        });
    });

    describe('getNegatedFailureMessage', function() {
        it('should return the message on failure', function() {
            $this->matcher->setExpectValue(1);
            Assertion::true($this->matcher->match(2));
            Assertion::same($this->matcher->getNegatedFailureMessage(), "Expected 2 not to be greater than 1");
        });
    });

});
