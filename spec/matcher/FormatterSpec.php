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
use expectation\matcher\Formatter;
use stdClass;

describe('Formatter', function() {

    before(function() {
        $this->formatter = new Formatter();
    });

    describe('toString', function() {
        context('when true value', function() {
            it('should return "true"', function() {
                Assertion::same($this->formatter->toString(true), 'true');
            });
        });
        context('when false value', function() {
            it('should return "false"', function() {
                Assertion::same($this->formatter->toString(false), 'false');
            });
        });
        context('when null value', function() {
            it('should return "null"', function() {
                Assertion::same($this->formatter->toString(null), 'null');
            });
        });
        context('when string value', function() {
            it('should return string value', function() {
                Assertion::same($this->formatter->toString('foo'), '\'foo\'');
            });
        });
        context('when object value', function() {
            it('should return state of object', function() {
                Assertion::same($this->formatter->toString(new stdClass), "stdClass Object\n(\n)");
            });
        });
    });

});
