<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use expectation\matcher\TypeMatcher;
use expectation\matcher\Formatter;
use expectation\spec\helper\MatcherHelper;
use Assert\Assertion;


describe('TypeMatcher', function() {

    beforeEach(function() {
        $this->matcher = new TypeMatcher(new Formatter());
        $this->matcherHelper = new MatcherHelper($this->matcher);
    });

    describe('match', function() {
        describe('annotations', function() {
            beforeEach(function() {
                $this->annotations = $this->matcherHelper->getAnnotations('match');
            });
            it('have toBeA', function() {
                Assertion::keyExists($this->annotations, 'toBeA');
            });
            it('have toBeAn', function() {
                Assertion::keyExists($this->annotations, 'toBeAn');
            });
        });

        context('when the same type', function() {
            it('should return true', function() {
                $this->matcher->setExpectValue('string');
                Assertion::true($this->matcher->match('foo'));
            });
        });
        context('when not the same type', function() {
            it('should return false', function() {
                $this->matcher->setExpectValue('integer');
                Assertion::false($this->matcher->match('foo'));
            });
        });
    });

    describe('matchString', function() {
        describe('annotations', function() {
            beforeEach(function() {
                $this->annotations = $this->matcherHelper->getAnnotations('matchString');
            });
            it('have toBeString', function() {
                Assertion::keyExists($this->annotations, 'toBeString');
            });
        });
        it('should return true', function() {
            Assertion::true($this->matcher->matchString('foo'));
        });
    });
    describe('matchInteger', function() {
        describe('annotations', function() {
            beforeEach(function() {
                $this->annotations = $this->matcherHelper->getAnnotations('matchInteger');
            });
            it('have toBeInteger', function() {
                Assertion::keyExists($this->annotations, 'toBeInteger');
            });
        });
        it('should return true', function() {
            Assertion::true($this->matcher->matchInteger(1));
        });
    });
    describe('matchDouble', function() {
        describe('annotations', function() {
            beforeEach(function() {
                $this->annotations = $this->matcherHelper->getAnnotations('matchDouble');
            });
            it('have toBeDouble', function() {
                Assertion::keyExists($this->annotations, 'toBeDouble');
            });
        });

        it('should return true', function() {
            $doubleValue = 1.1;
            $doubleValue = (double) $doubleValue;
            Assertion::true($this->matcher->matchDouble($doubleValue));
        });
    });

    describe('matchFloat', function() {
        describe('annotations', function() {
            beforeEach(function() {
                $this->annotations = $this->matcherHelper->getAnnotations('matchFloat');
            });
            it('have toBeFloat', function() {
                Assertion::keyExists($this->annotations, 'toBeFloat');
            });
        });

        it('should return true', function() {
            $floatValue = 1.1;
            $floatValue = (float) $floatValue;
            Assertion::true($this->matcher->matchFloat($floatValue));
        });
    });

    describe('matchBoolean', function() {
        describe('annotations', function() {
            beforeEach(function() {
                $this->annotations = $this->matcherHelper->getAnnotations('matchBoolean');
            });
            it('have toBeBoolean', function() {
                Assertion::keyExists($this->annotations, 'toBeBoolean');
            });
        });

        it('should return true', function() {
            Assertion::true($this->matcher->matchBoolean(true));
        });
    });

    describe('getFailureMessage', function() {
        it('should return the message on failure', function() {
            $this->matcher->setExpectValue('integer');
            Assertion::false($this->matcher->match('bar'));
            Assertion::same($this->matcher->getFailureMessage(), "Expected integer, got string");
        });
    });

    describe('getNegatedFailureMessage', function() {
        it('should return the message on failure', function() {
            $this->matcher->setExpectValue('integer');
            Assertion::true($this->matcher->match(1));
            Assertion::same($this->matcher->getNegatedFailureMessage(), "Expected a type other than integer");
        });
    });

});
