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
use expectation\matcher\ArrayKeyMatcher;
use expectation\matcher\Formatter;
use expectation\spec\helper\MatcherHelper;


describe('ArrayKeyMatcher', function() {
    beforeEach(function() {
        $this->matcher = new ArrayKeyMatcher(new Formatter());
        $this->matcherHelper = new MatcherHelper($this->matcher);
    });

    describe('match', function() {
        describe('annotations', function() {
            beforeEach(function() {
                $this->annotations = $this->matcherHelper->getAnnotations('match');
            });
            it('have toHaveKey', function() {
                Assertion::keyExists($this->annotations, 'toHaveKey');
            });
        });
        context('when same value', function() {
            it('should return true', function() {
                $this->matcher->setExpectValue('foo');

                Assertion::true($this->matcher->match([
                    'foo' => 'bar'
                ]));
            });
        });
        context('when not same value', function() {
            it('should return false', function() {
                $this->matcher->setExpectValue('foo');

                Assertion::false($this->matcher->match([
                    'bar' => 'foo'
                ]));
            });
        });
    });

    describe('getFailureMessage', function() {
        it('should return the message on failure', function() {
            $this->matcher->setExpectValue('foo');
            Assertion::false($this->matcher->match([ 'bar' => 'foo' ]));
            Assertion::same($this->matcher->getFailureMessage(), "Expected array to have the key 'foo'");
        });
    });

    describe('getNegatedFailureMessage', function() {
        it('should return the message on failure', function() {
            $this->matcher->setExpectValue('foo');
            Assertion::true($this->matcher->match([ 'foo' => 'bar' ]));
            Assertion::same($this->matcher->getNegatedFailureMessage(), "Expected array not to have the key 'foo'");
        });
    });

});
