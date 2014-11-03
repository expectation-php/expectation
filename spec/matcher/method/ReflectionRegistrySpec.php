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
use \ReflectionMethod;
use expectation\matcher\method\ReflectionRegistry;
use \ArrayIterator;


describe('ReflectionRegistry', function() {
    beforeEach(function() {
        $this->method = new ReflectionMethod('\\expectation\\spec\\fixture\\matcher\\basic\\FixtureMatcher', 'match');
    });
    describe('#registerAll', function() {
        beforeEach(function() {
            $this->registry = new ReflectionRegistry();
            $this->registry->registerAll(new ArrayIterator([
                'toEquals' => $this->method
            ]));
            $this->result = $this->registry->get('toEquals');
        });
        it('register all reflection', function() {
            Assertion::same($this->result, $this->method);
        });
    });


});
