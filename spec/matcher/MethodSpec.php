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
use ReflectionMethod;
use expectation\matcher\Method;
use expectation\ExpectationException;


describe('Method', function() {

    before_each(function() {
        $this->method = new ReflectionMethod('\\expectation\\spec\\fixture\\matcher\\basic\\FixtureMatcher', 'match');
        $this->matcherMethod = new Method($this->method);
    });

    describe('positiveMatch', function() {
        context('when result is true', function() {
            it('should return true', function() {
                $this->matcherMethod->expectValue = true;
                $result = $this->matcherMethod->positiveMatch(true);

                Assertion::true($result);
            });
        });
        context('when result is false', function() {
            it('should throw expectation\ExpectationException', function() {
                $throwException = false;
                try {
                    $this->matcherMethod->expectValue = false;
                    $this->matcherMethod->positiveMatch(true);
                } catch (ExpectationException $exception) {
                    $throwException = $exception;
                }
                Assertion::isInstanceOf($throwException, 'expectation\ExpectationException');
            });
        });
    });

    describe('negativeMatch', function() {
        context('when result is true', function() {
            it('should return true', function() {
                $this->matcherMethod->expectValue = true;
                $result = $this->matcherMethod->negativeMatch(false);
                Assertion::true($result);
            });
        });
        context('when result is false', function() {
            it('should throw expectation\ExpectationException', function() {
                $throwException = false;
                try {
                    $this->matcherMethod->expectValue = false;
                    $this->matcherMethod->negativeMatch(false);
                } catch (ExpectationException $exception) {
                    $throwException = $exception;
                }
                Assertion::isInstanceOf($throwException, 'expectation\ExpectationException');
            });
        });
    });

});
