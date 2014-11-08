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
use expectation\matcher\PatternMatcher;

describe('PatternMatcher', function() {

    describe('match', function() {
        beforeEach(function() {
            $this->matcher = new PatternMatcher(new Formatter());
            $this->matcher->setExpectValue('/foo/');
        });
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
        context('when pattern unmatch', function() {
            beforeEach(function() {
                $this->matcher = new PatternMatcher(new Formatter());
                $this->matcher->setExpectValue('/foo/');
            });
            it('should return the message on failure', function() {
                Assertion::false($this->matcher->match('barbar'));
                Assertion::same($this->matcher->getFailureMessage(), "Expected 'barbar' to match '/foo/'");
            });
        });
        context('when prefix unmatch', function() {
            beforeEach(function() {
                $this->matcher = new PatternMatcher(new Formatter());
                $this->matcher->setExpectValue('foo');
            });
            it('should return the message on failure', function() {
                Assertion::false($this->matcher->matchPrefix('barfoo'));
                Assertion::same($this->matcher->getFailureMessage(), "Expected 'barfoo' to start with 'foo'");
            });
        });
        context('when suffix unmatch', function() {
            beforeEach(function() {
                $this->matcher = new PatternMatcher(new Formatter());
                $this->matcher->setExpectValue('foo');
            });
            it('should return the message on failure', function() {
                Assertion::false($this->matcher->matchSuffix('foobar'));
                Assertion::same($this->matcher->getFailureMessage(), "Expected 'foobar' to end with 'foo'");
            });
        });
    });

    describe('getNegatedFailureMessage', function() {
        context('when pattern unmatch', function() {
            beforeEach(function() {
                $this->matcher = new PatternMatcher(new Formatter());
                $this->matcher->setExpectValue('/foo/');
            });
            it('should return the message on failure', function() {
                Assertion::true($this->matcher->match('foobar'));
                Assertion::same($this->matcher->getNegatedFailureMessage(), "Expected 'foobar' not to match '/foo/'");
            });
        });
        context('when prefix unmatch', function() {
            beforeEach(function() {
                $this->matcher = new PatternMatcher(new Formatter());
                $this->matcher->setExpectValue('foo');
            });
            it('should return the message on failure', function() {
                Assertion::true($this->matcher->matchPrefix('foobar'));
                Assertion::same($this->matcher->getNegatedFailureMessage(), "Expected 'foobar' not to start with 'foo'");
            });
        });
        context('when suffix unmatch', function() {
            beforeEach(function() {
                $this->matcher = new PatternMatcher(new Formatter());
                $this->matcher->setExpectValue('foo');
            });
            it('should return the message on failure', function() {
                Assertion::true($this->matcher->matchSuffix('barfoo'));
                Assertion::same($this->matcher->getNegatedFailureMessage(), "Expected 'barfoo' not to end with 'foo'");
            });
        });
    });

});
