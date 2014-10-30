<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expectation;

use PhpCollection\Map;


/**
 * Class ConfigurationLoader
 * @package expectation
 */
class ConfigurationLoader
{

    /**
     * @param string $configurationFilePath
     * @return Configuration
     */
    public function load($configurationFilePath)
    {
        $configValues = include $configurationFilePath;
        $config = new Map($configValues);

        $builder = new ConfigurationBuilder();

        if ($config->containsKey('classes')) {
            $value = $config->get('classes');

            foreach ($value->get() as $matcherClassName) {
                $builder->registerMatcherClass($matcherClassName);
            }
        }

        if ($config->containsKey('namespaces')) {
            $value = $config->get('namespaces');

            foreach ($value->get() as $matcherNamespace => $matcherDirectory) {
                $builder->registerMatcherNamespace($matcherNamespace, $matcherDirectory);
            }
        }

        return $builder->build();
    }

}
