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

use expectation\matcher\TypeMatcher;
use expectation\matcher\Formatter;
use Assert\Assertion;

describe('TypeMatcher', function() {

    before_each(function() {
        $this->matcher = new TypeMatcher(new Formatter());
    });

    describe('match', function() {
        context('when the same type', function() {
            it('should return true', function() {
                $this->matcher->expectValue = 'string';
                Assertion::true($this->matcher->match('foo'));
            });
        });
        context('when not the same type', function() {
            it('should return false', function() {
                $this->matcher->expectValue = 'integer';
                Assertion::false($this->matcher->match('foo'));
            });
        });
    });

    describe('matchString', function() {
        it('should return true', function() {
            Assertion::true($this->matcher->matchString('foo'));
        });
    });
    describe('matchInteger', function() {
        it('should return true', function() {
            Assertion::true($this->matcher->matchInteger(1));
        });
    });
    describe('matchDouble', function() {
        it('should return true', function() {
            $doubleValue = 1.1;
            $doubleValue = (double) $doubleValue;
            Assertion::true($this->matcher->matchDouble($doubleValue));
        });
    });

    describe('matchFloat', function() {
        it('should return true', function() {
            $floatValue = 1.1;
            $floatValue = (float) $floatValue;
            Assertion::true($this->matcher->matchFloat($floatValue));
        });
    });

    describe('matchBoolean', function() {
        it('should return true', function() {
            Assertion::true($this->matcher->matchBoolean(true));
        });
    });

    describe('getFailureMessage', function() {
        it('should return the message on failure', function() {
            $this->matcher->expectValue = 'integer';
            Assertion::false($this->matcher->match('bar'));
            Assertion::same($this->matcher->getFailureMessage(), "Expected integer, got string");
        });
    });

    describe('getNegatedFailureMessage', function() {
        it('should return the message on failure', function() {
            $this->matcher->expectValue = 'integer';
            Assertion::true($this->matcher->match(1));
            Assertion::same($this->matcher->getNegatedFailureMessage(), "Expected a type other than integer");
        });
    });

});
