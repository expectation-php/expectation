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

use expectation\matcher\InstanceMatcher;
use expectation\matcher\Formatter;
use Assert\Assertion;
use stdClass;
use Exception;

describe('InstanceMatcher', function() {

    describe('match', function() {
        context('when the same class', function() {
            before(function() {
                $this->matcher = new InstanceMatcher(new Formatter());
                $this->matcher->expectValue = '\stdClass';
            });
            it('should return true', function() {
                Assertion::true($this->matcher->match(new stdClass()));
            });
        });
        context('when not the same class', function() {
            before(function() {
                $this->matcher = new InstanceMatcher(new Formatter());
                $this->matcher->expectValue = 'expect\matcher\InstanceExpectation';
            });
            it('should return false', function() {
                Assertion::false($this->matcher->match(new stdClass()));
            });
        });
    });

    describe('getFailureMessage', function() {
        before(function() {
            $this->matcher = new InstanceMatcher(new Formatter());
            $this->matcher->expectValue = '\stdClass';
        });
        it('should return the message on failure', function() {
            Assertion::false($this->matcher->match(new Exception('bar')));
            Assertion::same($this->matcher->getFailureMessage(), "Expected an instance of \stdClass, got Exception");
        });
    });

    describe('getNegatedFailureMessage', function() {
        before(function() {
            $this->matcher = new InstanceMatcher(new Formatter());
            $this->matcher->expectValue = '\stdClass';
        });
        it('should return the message on failure', function() {
            Assertion::false($this->matcher->match(new Exception('bar')));
            Assertion::same($this->matcher->getNegatedFailureMessage(), "Expected an instance other than \stdClass");
        });
    });

});
