<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expectation\matcher;


use RecursiveDirectoryIterator as NativeRecursiveDirectoryIterator;
use FilesystemIterator;
use RecursiveIteratorIterator;
use Iterator;


/**
 * Class RecursiveDirectoryIterator
 * @package expectation\matcher
 */
class RecursiveDirectoryIterator implements Iterator
{

    /**
     * @var \RecursiveIteratorIterator
     */
    private $iterator;


    /**
     * @param string $directory
     */
    public function __construct($directory)
    {
        $this->iterator = $this->createIterator($directory);
    }

    public function key() {
        return $this->iterator->key();
    }

    public function current() {
        return $this->iterator->current();
    }

    public function next() {
        $this->iterator->next();
    }

    public function rewind() {
        $this->iterator->rewind();
    }

    public function valid() {
        return $this->iterator->valid();
    }

    /**
     * @param string $directory
     * @return RecursiveIteratorIterator
     */
    private function createIterator($directory)
    {
        $directoryIterator = new NativeRecursiveDirectoryIterator($directory,
            FilesystemIterator::CURRENT_AS_FILEINFO |
            FilesystemIterator::KEY_AS_PATHNAME |
            FilesystemIterator::SKIP_DOTS
        );

        $filterIterator = new RecursiveIteratorIterator($directoryIterator,
            RecursiveIteratorIterator::LEAVES_ONLY);

        return $filterIterator;
    }

}
