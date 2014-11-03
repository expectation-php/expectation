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
use expectation\Expectation;
use expectation\spec\fixture\FixtureTestCase;


describe('DSL', function() {

    describe('expect', function() {
        beforeEach(function() {
            Expectation::configure();
            $this->testCase = new FixtureTestCase();
        });
        it('lookup matcher method', function() {
            $result = $this->testCase->expect(true)->toEqual(true);
            Assertion::true($result);
        });
    });

});
