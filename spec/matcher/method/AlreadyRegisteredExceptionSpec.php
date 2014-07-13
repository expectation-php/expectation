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
use expectation\matcher\method\AlreadyRegisteredException;

describe('AlreadyRegisteredException', function() {

    describe('getMessage', function() {
        before(function() {
            $this->registeredName = 'toEqual';
            $this->reflectionMethod = new ReflectionMethod('expectation\spec\fixture\matcher\basic\FixtureMatcher', 'match');
            $this->exception = new AlreadyRegisteredException($this->registeredName, $this->reflectionMethod);
        });
        it('should return message' ,function() {
            $messages[] = "'toEqual' method of matcher is already registered.";
            $messages[] = "Class is expectation\\spec\\fixture\\matcher\\basic\\FixtureMatcher, the method is registered with the match.";

            Assertion::same($this->exception->getMessage(), implode("\n", $messages));
        });
    });

});
