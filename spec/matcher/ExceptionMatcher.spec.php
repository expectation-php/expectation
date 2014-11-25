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
use expectation\matcher\ExceptionMatcher;
use expectation\matcher\Formatter;
use expectation\spec\helper\MatcherHelper;
use \Exception;
use \UnderflowException;


describe('ExceptionMatcher', function() {

    beforeEach(function() {
        $this->matcher = new ExceptionMatcher(new Formatter());
        $this->matcherHelper = new MatcherHelper($this->matcher);
    });

    describe('match', function() {
        describe('annotations', function() {
            beforeEach(function() {
                $this->annotations = $this->matcherHelper->getAnnotations('match');
            });
            it('have toThrow', function() {
                Assertion::keyExists($this->annotations, 'toThrow');
            });
        });
        context('when thrown an exception', function() {
            it('should return true', function() {
                $this->matcher->setExpectValue('Exception');
                Assertion::true($this->matcher->match(function() { throw new Exception(); }));
            });
        });
        context('when not thrown an exception', function() {
            it('should return false', function() {
                $this->matcher->setExpectValue('Exception');
                Assertion::false($this->matcher->match(function() {}));
            });
        });
    });

    describe('getFailureMessage', function() {
        context('when it does not throw an exception', function() {
            it('should return the message on failure', function() {
                $this->matcher->setExpectValue('Exception');
                Assertion::false($this->matcher->match(function() { }));
                Assertion::same($this->matcher->getFailureMessage(), "Expected Exception to be thrown, none thrown");
            });
        });
        context('when throw an exception', function() {
            it('should return the message on failure', function() {
                $this->matcher->setExpectValue('UnderflowException');
                Assertion::false($this->matcher->match(function() { throw new Exception(); }));
                Assertion::same($this->matcher->getFailureMessage(), "Expected UnderflowException to be thrown, got Exception");
            });
        });
    });

    describe('getNegatedFailureMessage', function() {
        it('should return the message on failure', function() {
            $this->matcher->setExpectValue('UnderflowException');
            Assertion::true($this->matcher->match(function() { throw new UnderflowException(); }));
            Assertion::same($this->matcher->getNegatedFailureMessage(), "Expected UnderflowException not to be thrown");
        });
    });

});
