<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use expectation\Expectation;


describe('Expectation', function() {

    describe('expect', function() {
        beforeEach(function() {
            Expectation::configure();
        });
        it('lookup matcher method', function() {
            Expectation::expect(true)->toEqual(true);
        });
    });

});
