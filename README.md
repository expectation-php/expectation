Expectation
===========

**expectation** is the assertion library for unit testing.  
This library inspired by [pho](https://github.com/danielstjules/pho) of bdd test framework.

[![Build Status](https://travis-ci.org/expectation-php/expectation.svg?branch=master)](https://travis-ci.org/expectation-php/expectation)
[![Stories in Ready](https://badge.waffle.io/expectation-php/expectation.svg?label=ready&title=Ready)](http://waffle.io/expectation-php/expectation)
[![Coverage Status](https://coveralls.io/repos/expectation-php/expectation/badge.png)](https://coveralls.io/r/expectation-php/expectation)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/expectation-php/expectation/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/expectation-php/expectation/?branch=master)
[![Dependency Status](https://www.versioneye.com/user/projects/545032df9fc4d53c65000294/badge.svg?style=flat)](https://www.versioneye.com/user/projects/545032df9fc4d53c65000294)

* [Requirements](#requirements)
* [Installation](#installation)
* [Basic usage](#basic-usage)
* [Basic matchers](https://github.com/expectation-php/expectation/wiki/Basic-matchers)
* [Custom-matchers](https://github.com/expectation-php/expectation/wiki/Custom-matchers)
* [Domain specific language](https://github.com/expectation-php/expectation/wiki/Domain-specific-language)


Requirements
---------------------------
* PHP >= 5.4


Installation
---------------------------

Please add the following items to **composer.json**.  
Then please run the **composer install**.

    {
        "require-dev": {
            "expectation/expectation": "1.3.1"
        }
    }

Basic usage
---------------------------

There is a need to set up to be able to use it.

	\expectation\Expectation::configure();

Use example is as follows.

	expect(1)->toEqual(1);
	expect(true)->toBeTrue();
	expect(true)->toBeFalse();

Run unit test
---------------------------

	composer test
