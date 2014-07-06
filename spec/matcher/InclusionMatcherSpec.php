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

use expectation\matcher\InclusionMatcher;
use expectation\matcher\Formatter;
use Assert\Assertion;

describe('InclusionMatcher', function() {

    before_each(function() {
        $this->matcher = new InclusionMatcher(new Formatter());
    });

    describe('match', function() {
        context('when actual is string', function() {
            context('when expect value is string', function() {
                it('should return true', function() {
                    $this->matcher->expectValue = 'foo';
                    Assertion::true($this->matcher->match('foobar'));
                });
            });
            context('when expect value is array', function() {
                it('should return true', function() {
                    $this->matcher->expectValue = ['foo'];
                    Assertion::true($this->matcher->match('foo'));
                });
            });
        });
        context('when actual is array', function() {
            context('when expect value is string', function() {
                it('should return true', function() {
                    $this->matcher->expectValue = 'foo';
                    Assertion::true($this->matcher->match(['foo']));
                });
            });
            context('when expect value is array', function() {
                it('should return true', function() {
                    $this->matcher->expectValue = ['foo'];
                    Assertion::true($this->matcher->match(['foo']));
                });
            });
        });
    });

    describe('getFailureMessage', function() {
        it('should return the message on failure', function() {
            $this->matcher->expectValue = 'foo';
            Assertion::false($this->matcher->match('barbar'));
            Assertion::same($this->matcher->getFailureMessage(), "Expected string to contain foo");
        });
    });

    describe('getNegatedFailureMessage', function() {
        it('should return the message on failure', function() {
            $this->matcher->expectValue = 'foo';
            Assertion::true($this->matcher->match('foobar'));
            Assertion::same($this->matcher->getNegatedFailureMessage(), "Expected string not to contain foo");
        });
    });

});
