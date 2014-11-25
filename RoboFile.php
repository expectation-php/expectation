<?php

use \Robo\Tasks;
use coverallskit\Configuration;
use coverallskit\ReportBuilder;


class RoboFile extends Tasks
{

    public function specAll()
    {
        return $this->taskExec('vendor/bin/peridot spec')->run();
    }

    public function phpMetrics()
    {
        return $this->taskExec('vendor/bin/phpmetrics src')->run();
    }

    public function specCoveralls()
    {
        $configuration = Configuration::loadFromFile('.coveralls.yml');
        $builder = ReportBuilder::fromConfiguration($configuration);
        $builder->build()->save()->upload();
    }

}
