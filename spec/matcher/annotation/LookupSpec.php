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
use expectation\matcher\annotation\Lookup;

describe('Lookup', function() {

    beforeEach(function() {
        $this->method = new ReflectionMethod('\\expectation\\spec\\fixture\\matcher\\basic\\FixtureMatcher', 'match');
        $this->annotation = new Lookup([
            'name' => 'toEqual'
        ]);
    });

    describe('getLookupName', function() {
        it('should return register name', function() {
            $name = $this->annotation->getLookupName();
            Assertion::same($name, "toEqual");
        });
    });

});
