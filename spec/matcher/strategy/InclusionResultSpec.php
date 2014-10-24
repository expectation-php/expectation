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

describe('InclusionResult', function() {
    beforeEach(function() {
        $this->expectValues = [1, 2, 3];
        $this->matchResults = [1, 2, 3];
        $this->unmatchResults = [4];
        $this->inclusionResult = new InclusionResult($this->expectValues, $this->matchResults, $this->unmatchResults);
    });
    describe('#getMatchResults', function() {
        beforeEach(function() {
            $this->result = $this->inclusionResult->getMatchResults();
        });
        it('return match results', function() {
            Assertion::same($this->result, $this->matchResults);
        });
    });
    describe('#getUnmatchResults', function() {
        beforeEach(function() {
            $this->result = $this->inclusionResult->getUnmatchResults();
        });
        it('return unmatch results', function() {
            Assertion::same($this->result, $this->unmatchResults);
        });
    });
    describe('#isMatched', function() {
        context('when match', function() {
            beforeEach(function() {
                $this->expectValues = [1, 2, 3];
                $this->matchResults = [1, 2, 3];
                $this->unmatchResults = [4];
                $this->inclusionResult = new InclusionResult($this->expectValues, $this->matchResults, $this->unmatchResults);
                $this->result = $this->inclusionResult->isMatched();
            });
            it('return true', function() {
                Assertion::true($this->result);
            });
        });
        context('when unmatch', function() {
            beforeEach(function() {
                $this->expectValues = [1, 2, 3, 4];
                $this->matchResults = [1, 2, 3];
                $this->unmatchResults = [4];
                $this->inclusionResult = new InclusionResult($this->expectValues, $this->matchResults, $this->unmatchResults);
                $this->result = $this->inclusionResult->isMatched();
            });
            it('return false', function() {
                Assertion::false($this->result);
            });
        });
    });
});
