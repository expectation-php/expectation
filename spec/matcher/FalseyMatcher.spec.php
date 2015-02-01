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
use expectation\matcher\FalseyMatcher;
use expectation\spec\helper\MatcherHelper;


describe('FalseyMatcher', function() {

    beforeEach(function() {
        $this->matcher = new FalseyMatcher(new Formatter());
        $this->matcherHelper = new MatcherHelper($this->matcher);
    });

    describe('match', function() {
        describe('annotations', function() {
            beforeEach(function() {
                $this->annotations = $this->matcherHelper->getAnnotations('match');
            });
            it('have toBeFalsey', function() {
                Assertion::keyExists($this->annotations, 'toBeFalsey');
            });
        });
        context('when actual is true', function() {
            it('return false', function() {
                Assertion::false($this->matcher->match(true));
            });
        });
        context('when actual is false', function() {
            it('return true', function() {
                Assertion::true($this->matcher->match(false));
            });
        });
        context('when actual is blank', function() {
            it('return false', function() {
                Assertion::false($this->matcher->match(''));
            });
        });
        context('when actual is null', function() {
            it('return true', function() {
                Assertion::true($this->matcher->match(null));
            });
        });
        context('when actual is 0', function() {
            it('return false', function() {
                Assertion::false($this->matcher->match(0));
            });
        });
    });

    describe('getFailureMessage', function() {
        it('should return the message on failure', function() {
            Assertion::false($this->matcher->match(true));
            Assertion::same($this->matcher->getFailureMessage(), "Expected falsey value, got true");
        });
    });

    describe('getNegatedFailureMessage', function() {
        it('should return the message on failure', function() {
            Assertion::true($this->matcher->match(false));
            Assertion::same($this->matcher->getNegatedFailureMessage(), "Expected truthy value, got false");
        });
    });

});
