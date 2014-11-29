<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use expectation\matcher\InstanceMatcher;
use expectation\matcher\Formatter;
use expectation\spec\helper\MatcherHelper;
use Assert\Assertion;
use \stdClass;
use \Exception;


describe('InstanceMatcher', function() {

    beforeEach(function() {
        $this->matcher = new InstanceMatcher(new Formatter());
        $this->matcherHelper = new MatcherHelper($this->matcher);
    });

    describe('match', function() {
        describe('annotations', function() {
            beforeEach(function() {
                $this->annotations = $this->matcherHelper->getAnnotations('match');
            });
            it('have toBeAnInstanceOf', function() {
                Assertion::keyExists($this->annotations, 'toBeAnInstanceOf');
            });
        });

        context('when the same class', function() {
            it('should return true', function() {
                $this->matcher->setExpectValue('\stdClass');
                Assertion::true($this->matcher->match(new stdClass()));
            });
        });
        context('when not the same class', function() {
            it('should return false', function() {
                $this->matcher->setExpectValue('expect\matcher\InstanceExpectation');
                Assertion::false($this->matcher->match(new stdClass()));
            });
        });
    });

    describe('getFailureMessage', function() {
        it('should return the message on failure', function() {
            $this->matcher->setExpectValue('\stdClass');
            Assertion::false($this->matcher->match(new Exception('bar')));
            Assertion::same($this->matcher->getFailureMessage(), "Expected an instance of \stdClass, got Exception");
        });
    });

    describe('getNegatedFailureMessage', function() {
        it('should return the message on failure', function() {
            $this->matcher->setExpectValue('\stdClass');
            Assertion::true($this->matcher->match(new stdClass()));
            Assertion::same($this->matcher->getNegatedFailureMessage(), "Expected an instance other than \stdClass");
        });
    });

});
