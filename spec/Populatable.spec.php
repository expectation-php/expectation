<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use expectation\spec\fixture\FixturePopulatableObject;
use expectation\BadPropertyAccessException;
use \Assert\Assertion;

describe('Populatable', function() {
    describe('populate', function() {
        context('when have not property', function() {
            beforeEach(function() {
                $this->throwException = null;
                try {
                    new FixturePopulatableObject([
                        'foo' => ''
                    ]);
                } catch (BadPropertyAccessException $exception) {
                    $this->throwException = $exception;
                }
            });
            it('throw \expectation\BadPropertyAccessException', function() {
                Assertion::isInstanceOf($this->throwException, '\expectation\BadPropertyAccessException');
            });
        });
    });
});
