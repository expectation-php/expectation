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
use expectation\dsl as expectation;
use expectation\Expectation as AliasExpectation;
use expectation\ExpectationException;


describe('DSL', function() {
    describe('expect', function() {
        beforeEach(function() {
            AliasExpectation::configure();

            $this->throwException = null;
        });
        it('throw expectation\ExpectationException', function() {
            try {
                expectation\expect(true)->toEqual(true);
            } catch (ExpectationException $exception) {
                $this->throwException = $exception;
            }
            Assertion::same($this->throwException, null);
        });
    });
});
