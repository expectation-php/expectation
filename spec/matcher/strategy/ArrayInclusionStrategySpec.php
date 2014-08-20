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
use expectation\matcher\strategy\ArrayInclusionStrategy;

describe('ArrayInclusionStrategy', function() {
    before(function() {
        $this->strategy = new ArrayInclusionStrategy([1, 2, 3]);
    });
    describe('#match', function() {
        before(function() {
            $this->result = $this->strategy->match([1]);
        });
        it('return expectation\matcher\strategy\InclusionResult instance');
    });
});
