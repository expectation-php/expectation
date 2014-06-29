expectation
===========

**expectation** is the assertion library for unit testing.
This library inspired by [pho](https://github.com/danielstjules/pho) of bdd test framework.

[![Build Status](https://travis-ci.org/holyshared/expectation.svg?branch=master)](https://travis-ci.org/holyshared/expectation)
[![Stories in Ready](https://badge.waffle.io/holyshared/expectation.png?label=ready&title=Ready)](https://waffle.io/holyshared/expectation)
[![Coverage Status](https://coveralls.io/repos/holyshared/expectation/badge.png?branch=master)](https://coveralls.io/r/holyshared/expectation?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/holyshared/expectation/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/holyshared/expectation/?branch=master)

Requirements
---------------------------
* PHP >= 5.4


Installation
---------------------------

Please add the following items to **composer.json**.
Then please run the **composer install**.

    {
        "require-dev": {
            "expectation/expectation": "dev-master"
        }
    }

Basic matchers
---------------------------

### EqualMatcher

    expect('foo')->toEqual('foo'); //pass
    expect(1)->toEqual(1); //pass
    expect(new stdClass())->toEqual(new stdClass()); //fail
