<?php

use \Robo\Tasks;
use \coverallskit\robo\CoverallsKitTasks;

/**
 * Class RoboFile
 */
class RoboFile extends Tasks
{

    use CoverallsKitTasks;

    public function specAll()
    {
        return $this->taskExec('vendor/bin/peridot spec')->run();
    }

    public function phpMetrics()
    {
        return $this->taskExec('vendor/bin/phpmetrics src')->run();
    }

    public function coverallsUpload()
    {
        $result = $this->taskCoverallsKit()
            ->configure('coveralls.toml')
            ->run();

        return $result;
    }

}
