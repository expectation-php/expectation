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
use expectation\MatcherFactory;

describe('MatcherFactory', function() {

    before(function() {
        $this->method = new ReflectionMethod('\\expectation\\spec\\fixture\\FixtureMatcher', 'match');
        $this->factory = new MatcherFactory($this->method);
    });

    describe('withArguments', function() {
        context('when no arugments', function() {
            before(function() {
                $this->matcher = $this->factory->withArguments([]);
            });
            it('should expected is null', function() {
                Assertion::same($this->matcher->expected, null);
            });
            it('should return expectation\MatcherInterface', function() {
                Assertion::isInstanceOf($this->matcher, '\expectation\spec\fixture\FixtureMatcher');
            });
        });
        context('when with arugments', function() {
            before(function() {
                $this->matcher = $this->factory->withArguments([true]);
            });
            it('should has expected', function() {
                Assertion::same($this->matcher->expected, true);
            });
            it('should return expectation\MatcherInterface', function() {
                Assertion::isInstanceOf($this->matcher, '\expectation\spec\fixture\FixtureMatcher');
            });
        });
    });

});
