<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Assert\Assertion;
use ReflectionMethod;
use expectation\matcher\method\MethodFactory;

describe('MethodFactory', function() {

    beforeEach(function() {
        $this->method = new ReflectionMethod('\\expectation\\spec\\fixture\\matcher\\basic\\FixtureMatcher', 'match');
        $this->factory = new MethodFactory($this->method);
    });

    describe('withArguments', function() {
        context('when no arugments', function() {
            beforeEach(function() {
                $this->matcherMethod = $this->factory->withArguments([]);
            });
            it('should expected is null', function() {
                Assertion::same($this->matcherMethod->expectValue, null);
            });
            it('should return \expectation\matcher\MethodInterface', function() {
                Assertion::isInstanceOf($this->matcherMethod, '\expectation\matcher\MethodInterface');
            });
        });
        context('when with one arugments', function() {
            beforeEach(function() {
                $this->matcherMethod = $this->factory->withArguments([true]);
            });
            it('should has expected', function() {
                Assertion::same($this->matcherMethod->expectValue, true);
            });
            it('should return \expectation\matcher\MethodInterface', function() {
                Assertion::isInstanceOf($this->matcherMethod, '\expectation\matcher\MethodInterface');
            });
        });
        context('when with two arugments', function() {
            beforeEach(function() {
                $this->matcherMethod = $this->factory->withArguments(["foo", "bar"]);
            });
            it('should has expected', function() {
                Assertion::same($this->matcherMethod->expectValue, ["foo", "bar"]);
            });
            it('should return \expectation\matcher\MethodInterface', function() {
                Assertion::isInstanceOf($this->matcherMethod, '\expectation\matcher\MethodInterface');
            });
        });
    });

});
