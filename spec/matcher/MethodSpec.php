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
use expectation\matcher\Method;

describe('Method', function() {

    before(function() {
        $this->method = new ReflectionMethod('\\expectation\\spec\\fixture\\FixtureMatcher', 'match');
    });

    describe('positiveMatch', function() {
        before(function() {
            $this->matcherMethod = new Method($this->method);
        });
        it('', function() {
            $result = $this->matcherMethod->expected(true)
                ->positiveMatch(true);
            Assertion::true($result);
        });
    });

    describe('negativeMatch', function() {
        before(function() {
            $this->matcherMethod = new Method($this->method);
        });
        it('', function() {
            $result = $this->matcherMethod->expected(false)
                ->negativeMatch(true);
            Assertion::true($result);
        });
    });

});
