<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use expectation\matcher\PrintMatcher;
use expectation\matcher\Formatter;
use Assert\Assertion;

describe('PrintMatcher', function() {

    beforeEach(function() {
        $this->matcher = new PrintMatcher(new Formatter());
    });

    describe('match', function() {
        context('when the same class', function() {
            beforeEach(function() {
                $this->matcher->setExpectValue('foo');
            });
            it('should return true', function() {
                Assertion::true($this->matcher->match(function() {
                    echo 'foo';
                }));
            });
        });
        context('when not the same class', function() {
            beforeEach(function() {
                $this->matcher->setExpectValue('foo');
            });
            it('should return false', function() {
                Assertion::false($this->matcher->match(function() {
                    echo 'bar';
                }));
            });
        });
    });

    describe('getFailureMessage', function() {
        beforeEach(function() {
            $this->matcher->setExpectValue('foo');
        });
        it('should return the message on failure', function() {
            Assertion::false($this->matcher->match(function() {
                echo 'bar';
            }));
            Assertion::same($this->matcher->getFailureMessage(), "Expected 'foo', got 'bar'");
        });
    });

    describe('getNegatedFailureMessage', function() {
        beforeEach(function() {
            $this->matcher->setExpectValue('foo');
        });
        it('should return the message on failure', function() {
            Assertion::true($this->matcher->match(function() {
                echo 'foo';
            }));
            Assertion::same($this->matcher->getNegatedFailureMessage(), "Expected output other than 'foo'");
        });
    });

});
