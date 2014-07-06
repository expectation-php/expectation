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

use expectation\matcher\InstanceMatcher;
use expectation\matcher\Formatter;
use Assert\Assertion;
use stdClass;
use Exception;

describe('InstanceMatcher', function() {

    before_each(function() {
        $this->matcher = new InstanceMatcher(new Formatter());
    });

    describe('match', function() {
        context('when the same class', function() {
            it('should return true', function() {
                $this->matcher->expectValue = '\stdClass';
                Assertion::true($this->matcher->match(new stdClass()));
            });
        });
        context('when not the same class', function() {
            it('should return false', function() {
                $this->matcher->expectValue = 'expect\matcher\InstanceExpectation';
                Assertion::false($this->matcher->match(new stdClass()));
            });
        });
    });

    describe('getFailureMessage', function() {
        it('should return the message on failure', function() {
            $this->matcher->expectValue = '\stdClass';
            Assertion::false($this->matcher->match(new Exception('bar')));
            Assertion::same($this->matcher->getFailureMessage(), "Expected an instance of \stdClass, got Exception");
        });
    });

    describe('getNegatedFailureMessage', function() {
        it('should return the message on failure', function() {
            $this->matcher->expectValue = '\stdClass';
            Assertion::true($this->matcher->match(new stdClass()));
            Assertion::same($this->matcher->getNegatedFailureMessage(), "Expected an instance other than \stdClass");
        });
    });

});
