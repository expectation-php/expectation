<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expectation\configuration;

use expectation\ConfigurationBuilder;

/**
 * Class RootSection
 * @package expectation\configuration
 */
class RootSection implements SectionInterface
{

    /**
     * @var SectionInterface[]
     */
    private $sections = [];


    /**
     * @param SectionInterface[] $sections
     */
    public function __construct(array $sections = [])
    {
        $this->addAllSection($sections);
    }

    /**
     * @param SectionInterface $section
     */
    public function addSection(SectionInterface $section)
    {
        $this->sections[] = $section;
    }

    /**
     * @param SectionInterface[] $section
     */
    public function addAllSection(array $sections)
    {
        foreach ($sections as $section) {
            $this->addSection($section);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function applyTo(ConfigurationBuilder $builder)
    {


    }

}
