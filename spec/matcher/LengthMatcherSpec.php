<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use expectation\matcher\Formatter;
use expectation\matcher\LengthMatcher;
use Assert\Assertion;
use \ArrayObject;

describe('LengthMatcher', function() {

    beforeEach(function() {
        $this->matcher = new LengthMatcher(new Formatter());
    });

    describe('match', function() {
        context('when string type', function() {
            context('when have length', function() {
                it('should return true', function() {
                    $this->matcher->setExpectValue(3);
                    Assertion::true($this->matcher->match('foo'));
                });
            });
            context('when have not length', function() {
                it('should return false', function() {
                    $this->matcher->setExpectValue(9999);
                    Assertion::false($this->matcher->match('foo'));
                });
            });
        });
        context('when array type', function() {
            context('when have length', function() {
                it('should return true', function() {
                    $this->matcher->setExpectValue(2);
                    Assertion::true($this->matcher->match(array(1, 2)));
                });
            });
            context('when have not length', function() {
                it('should return false', function() {
                    $this->matcher->setExpectValue(3);
                    Assertion::false($this->matcher->match(array(1, 2)));
                });
            });
        });

        context('when Countable type', function() {
            context('when have length', function() {
                it('should return true', function() {
                    $this->matcher->setExpectValue(2);
                    Assertion::true($this->matcher->match(new ArrayObject(array(1, 2))));
                });
            });
            context('when have not length', function() {
                it('should return false', function() {
                    $this->matcher->setExpectValue(3);
                    Assertion::false($this->matcher->match(new ArrayObject(array(1, 2))));
                });
            });
        });
    });

    describe('matchEmpty', function() {
        it('should return true', function() {
            Assertion::true($this->matcher->matchEmpty([]));
        });
    });

    describe('getFailureMessage', function() {
        it('should return the message on failure', function() {
            $this->matcher->setExpectValue(3);
            Assertion::false($this->matcher->match(new ArrayObject(array(1, 2))));
            Assertion::same($this->matcher->getFailureMessage(), "Expected ArrayObject to have a length of 3");
        });
    });
    describe('getNegatedFailureMessage', function() {
        it('should return the message on failure', function() {
            $this->matcher->setExpectValue(2);
            Assertion::true($this->matcher->match(new ArrayObject(array(1, 2))));
            Assertion::same($this->matcher->getNegatedFailureMessage(), "Expected ArrayObject not to have a length of 2");
        });
    });

});
