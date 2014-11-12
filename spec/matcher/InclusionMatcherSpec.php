<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use expectation\matcher\InclusionMatcher;
use expectation\matcher\Formatter;
use Assert\Assertion;
use \stdClass;
use \InvalidArgumentException;

describe('InclusionMatcher', function() {

    beforeEach(function() {
        $this->matcher = new InclusionMatcher(new Formatter());
    });

    describe('match', function() {
        context('when actual is string', function() {
            context('when expect value is string', function() {
                it('should return true', function() {
                    $this->matcher->setExpectValue('foo');
                    Assertion::true($this->matcher->match('foobar'));
                });
            });
            context('when expect value is array', function() {
                it('should return true', function() {
                    $this->matcher->setExpectValue(['foo']);
                    Assertion::true($this->matcher->match('foo'));
                });
            });
        });
        context('when actual is array', function() {
            context('when expect value is string', function() {
                it('should return true', function() {
                    $this->matcher->setExpectValue('foo');
                    Assertion::true($this->matcher->match(['foo']));
                });
            });
            context('when expect value is array', function() {
                it('should return true', function() {
                    $this->matcher->setExpectValue(['foo']);
                    Assertion::true($this->matcher->match(['foo']));
                });
            });
        });
        context('when actual is not string or array', function() {
            it('should throw InvalidArgumentException', function() {
                $throwException = false;
                try {
                    $this->matcher->match(new stdClass());
                } catch (InvalidArgumentException $exception) {
                    $throwException = $exception;
                }
                Assertion::isInstanceOf($throwException, 'InvalidArgumentException');
            });
        });
    });

    describe('getFailureMessage', function() {
        context('when actual is string', function() {
            it('should return the message on failure', function() {
                $this->matcher->setExpectValue('foo');
                Assertion::false($this->matcher->match('barbar'));
                Assertion::same($this->matcher->getFailureMessage(), "Expected string to contain foo");
            });
        });
        context('when actual is array', function() {
            it('should return the message on failure', function() {
                $this->matcher->setExpectValue('foo');
                Assertion::false($this->matcher->match(['bar', 'bar1']));
                Assertion::same($this->matcher->getFailureMessage(), "Expected array to contain foo");
            });
        });
    });

    describe('getNegatedFailureMessage', function() {
        context('when actual is string', function() {
            it('should return the message on failure', function() {
                $this->matcher->setExpectValue('foo');
                Assertion::true($this->matcher->match('foobar'));
                Assertion::same($this->matcher->getNegatedFailureMessage(), "Expected string not to contain foo");
            });
        });
        context('when actual is array', function() {
            it('should return the message on failure', function() {
                $this->matcher->setExpectValue(['foo']);
                Assertion::true($this->matcher->match(['foo']));
                Assertion::same($this->matcher->getNegatedFailureMessage(), "Expected array not to contain foo");
            });
        });
    });

});
