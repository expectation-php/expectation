<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expectation\matcher\reflection;

use \ReflectionMethod;
use \Iterator;
use \Countable;


/**
 * Interface ReflectionRegistryInterface
 * @package expectation\matcher\reflection
 */
interface ReflectionRegistryInterface extends Countable
{

    /**
     * @param string $name
     * @throws ReflectionNotFoundException
     */
    public function get($name);

    /**
     * @param string $name
     * @return bool
     */
    public function contains($name);

    /**
     * @param string $name
     * @param ReflectionMethod $reflection
     * @throws AlreadyRegisteredException
     */
    public function register($name, ReflectionMethod $reflection);

    /**
     * @param Iterator $iterator
     */
    public function registerAll(Iterator $iterator);

}
