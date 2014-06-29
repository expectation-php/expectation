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
use expectation;
use expectation\Expectation as AliasExpectation;
use expectation\ConfigrationBuilder;

describe('DSL', function() {
    before(function() {
        AliasExpectation::configure(function(ConfigrationBuilder $config) {
            $config->registerMatcherNamespace(
                'expectation\spec\fixture',
                __DIR__ . '/fixture'
            );
        });
    });
    describe('Equal matcher', function() {
        describe('toEqual', function() {
            context('when pass', function() {
                it('should return true', function() {
                    Assertion::true(expectation\expect(true)->toEqual(true));
                });
            });
        });
        describe('toBeTrue', function() {
            context('when pass', function() {
                it('should return true', function() {
                    Assertion::true(expectation\expect(true)->toBeTrue());
                });
            });
        });
        describe('toBeFalse', function() {
            context('when pass', function() {
                it('should return true', function() {
                    Assertion::true(expectation\expect(false)->toBeFalse());
                });
            });
        });
        describe('toBeNull', function() {
            context('when pass', function() {
                it('should return true', function() {
                    Assertion::true(expectation\expect(null)->toBeNull());
                });
            });
        });
    });

});
