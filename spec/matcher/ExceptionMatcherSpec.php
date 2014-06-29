<?php

/**
 * This file is part of expect package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 *
 * @package expect
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 */

namespace Preview\DSL\BDD;

use Assert\Assertion;
use expectation\matcher\ExceptionMatcher;
use expectation\matcher\Formatter;
use Exception;

describe('ExceptionMatcher', function() {

    before_each(function() {
        $this->matcher = new ExceptionMatcher(new Formatter());
    });

    describe('match', function() {
        context('when thrown an exception', function() {
            it('should return true', function() {
                $this->matcher->expectValue = 'Exception';
                Assertion::true($this->matcher->match(function() { throw new Exception(); }));
            });
        });
        context('when not thrown an exception', function() {
            it('should return false', function() {
                $this->matcher->expectValue = 'Exception';
                Assertion::false($this->matcher->match(function() {}));
            });
        });
    });

    describe('getFailureMessage', function() {
        context('when it does not throw an exception', function() {
            it('should return the message on failure', function() {
                $this->matcher->expectValue = 'Exception';
                Assertion::false($this->matcher->match(function() { }));
                Assertion::same($this->matcher->getFailureMessage(), "Expected Exception to be thrown, none thrown");
            });
        });
        context('when throw an exception', function() {
            it('should return the message on failure', function() {
                $this->matcher->expectValue = 'UnderflowException';
                Assertion::false($this->matcher->match(function() { throw new Exception(); }));
                Assertion::same($this->matcher->getFailureMessage(), "Expected UnderflowException to be thrown, got Exception");
            });
        });
    });

    describe('getNegatedFailureMessage', function() {
        it('should return the message on failure', function() {
            $this->matcher->expectValue = 'UnderflowException';
            Assertion::false($this->matcher->match(function() { throw new Exception(); }));
            Assertion::same($this->matcher->getNegatedFailureMessage(), "Expected UnderflowException not to be thrown");
        });
    });

});
