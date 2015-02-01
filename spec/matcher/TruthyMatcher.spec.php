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
use expectation\matcher\Formatter;
use expectation\matcher\TruthyMatcher;
use expectation\spec\helper\MatcherHelper;


describe('TruthyMatcher', function() {

    beforeEach(function() {
        $this->matcher = new TruthyMatcher(new Formatter());
        $this->matcherHelper = new MatcherHelper($this->matcher);
    });

    describe('match', function() {
        describe('annotations', function() {
            beforeEach(function() {
                $this->annotations = $this->matcherHelper->getAnnotations('match');
            });
            it('have toBeTruthy', function() {
                Assertion::keyExists($this->annotations, 'toBeTruthy');
            });
        });
    });

});
