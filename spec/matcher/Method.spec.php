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
use \ReflectionMethod;
use expectation\matcher\Method;
use expectation\ExpectationException;


describe('Method', function() {

    beforeEach(function() {
        $this->method = new ReflectionMethod('\\expectation\\spec\\fixture\\matcher\\basic\\FixtureMatcher', 'match');
        $this->matcherMethod = new Method($this->method);
    });

    describe('positiveMatch', function() {
        context('when conditions are matched', function() {
            beforeEach(function() {
                $this->throwException = null;
                $this->matcherMethod->setExpectValue(true);
            });
            it('not throw exception', function() {
                try {
                    $this->matcherMethod->positiveMatch(true);
                } catch (ExpectationException $exception) {
                    $this->throwException = true;
                }
                Assertion::same($this->throwException, null);
            });
        });
        context('when the condition is not match', function() {
            beforeEach(function() {
                $this->throwException = null;
                $this->matcherMethod->setExpectValue(false);
            });
            it('throw expectation\ExpectationException', function() {
                try {
                    $this->matcherMethod->positiveMatch(true);
                } catch (ExpectationException $exception) {
                    $this->throwException = $exception;
                }
                Assertion::isInstanceOf($this->throwException, 'expectation\ExpectationException');
            });
        });
    });

    describe('negativeMatch', function() {
        context('when conditions are matched', function() {
            beforeEach(function() {
                $this->throwException = null;
                $this->matcherMethod->setExpectValue(true);
            });
            it('not throw exception', function() {
                try {
                    $this->matcherMethod->negativeMatch(false);
                } catch (ExpectationException $exception) {
                    $this->throwException = $exception;
                }
                Assertion::same($this->throwException, null);
            });
        });
        context('when the condition is not match', function() {
            beforeEach(function() {
                $this->throwException = null;
                $this->matcherMethod->setExpectValue(false);
            });

            it('throw expectation\ExpectationException', function() {
                try {
                    $this->matcherMethod->negativeMatch(false);
                } catch (ExpectationException $exception) {
                    $this->throwException = $exception;
                }
                Assertion::isInstanceOf($this->throwException, 'expectation\ExpectationException');
            });
        });
    });

});
