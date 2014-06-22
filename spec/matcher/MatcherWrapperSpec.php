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
use expectation\matcher\MethodWrapper;

describe('MethodWrapper', function() {

    before(function() {
        $this->method = new ReflectionMethod('\\expectation\\spec\\fixture\\FixtureMatcher', 'match');
    });

    describe('positiveMatch', function() {
        before(function() {
            $this->wrapper = new MethodWrapper($this->method);
        });
        it('', function() {
            $result = $this->wrapper->expected(true)
                ->positiveMatch(true);
            Assertion::true($result);
        });
    });

    describe('negativeMatch', function() {
        before(function() {
            $this->wrapper = new MethodWrapper($this->method);
        });
        it('', function() {
            $result = $this->wrapper->expected(false)
                ->negativeMatch(true);
            Assertion::true($result);
        });
    });

});
