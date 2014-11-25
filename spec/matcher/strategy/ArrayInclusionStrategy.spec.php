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
use expectation\matcher\strategy\InclusionResult;
use expectation\matcher\strategy\ArrayInclusionStrategy;

describe('ArrayInclusionStrategy', function() {
    beforeEach(function() {
        $this->strategy = new ArrayInclusionStrategy([1, 4, 5]);
    });
    describe('#match', function() {
        beforeEach(function() {
            $this->result = $this->strategy->match([1, 2, 3]);
        });
        it('return expectation\matcher\strategy\InclusionResult instance', function() {
            Assertion::isInstanceOf($this->result, 'expectation\matcher\strategy\InclusionResult');
        });
        describe('result', function() {
            it('has match results', function() {
                Assertion::count($this->result->getMatchResults(), 1);
            });
            it('has unmatch results', function() {
                Assertion::count($this->result->getUnmatchResults(), 2);
            });
        });
    });
});
