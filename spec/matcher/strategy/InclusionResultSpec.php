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
use expectation\matcher\strategy\InclusionResult;

describe('InclusionResult', function() {
    before(function() {
        $this->inclusionResult = new InclusionResult([1, 2, 3], [4]);
    });
    describe('#getMatchResults', function() {
        before(function() {
            $this->result = $this->inclusionResult->getMatchResults();
        });
        it('return match results');
    });
});
