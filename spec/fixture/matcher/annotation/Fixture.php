<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expectation\spec\fixture\matcher\annotation;

use expectation\matcher\AnnotationInterface;

/**
 * Class Fixture
 *
 * @Annotation
 * @Target({"METHOD"})
 * @package expectation\spec\fixture\matcher\annotation
 */
final class Fixture implements AnnotationInterface
{
}
